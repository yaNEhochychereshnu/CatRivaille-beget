<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Notifications\OrderStatusChanged;
use App\Notifications\OrderProcessingNotification;
use App\Notifications\OrderAssemblyNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->is_admin) {
            $orders = Order::whereNot('status', 'В корзине')->get();
        } else {
            $orders = Order::whereNot('status', 'В корзине')->where('user_id', Auth::user()->id)->get();
        }

        return view('orders.index', ['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Hash::check($request->password, Auth::user()->password)) {
            // Получаем заказ, который находится в корзине
            $order = Auth::user()->orders()->firstWhere('status', 'В корзине');
            $order->status = 'Создан';
            $order->sum = $request->sum;
            $order->full_name = $request->full_name;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->postcode = $request->postcode;
            $order->save();

            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->status = 'В корзине';
            $order->save();

            return redirect('/orders')->with('info', 'Заказ успешно оформлен. Перейдите к оплате через личный кабинет.');
        } else {
            return redirect()->back()->with('info', 'Пароль неверный. Повторите попытку.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('products');
        return view('orders.show', ['order' => $order]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
{
    if (!Auth::user()->is_admin) {
        return redirect()->route('orders.index')->with('info', 'У вас нет прав для обновления статуса заказа.');
    }

    $validator = Validator::make($request->all(), [
        'status' => 'required|in:Создан,В обработке,Подтвержден,В сборке,Отправлен,Завершен',
        'trackcode' => 'nullable|string|max:255', // Добавляем правило для трек-кода
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $order->status = $request->input('status');

    // Если админ вводит трек-код, то статус меняется на "Отправлено"
    if ($request->has('trackcode')) {
        $order->trackcode = $request->input('trackcode');
        // Не меняем статус заказа, если трек-код передан
    }

   $email = 'anastasia.semeniuk2k17@yandex.ru';
    if ($order->status === 'В сборке') {
        $order->save();
        Notification::route('mail', $email)->notify(new OrderAssemblyNotification($order, $email));
    } else {
        $order->save();
    }

    // Отправляем уведомление пользователю о смене статуса заказа
    $order->user->notify(new OrderStatusChanged($order));

    return redirect()->route('orders.index')->with('info', 'Статус заказа успешно обновлен.');
}


    public function payment(Order $order)
{
        return view('orders.payment', compact('order'));
}

    public function uploadReceipt(Request $request, Order $order)
{
    $request->validate([
        'receipt' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $img = $request->file('receipt');
    $imgName = $img->getClientOriginalName();
    $img->move(public_path('/img'), $imgName);
    $img_path = 'img/' . $imgName;

    $email = 'anastasia.semeniuk2k17@yandex.ru';
    $order->receipt_path = $img_path;
    $order->status = 'В обработке';
    $order->save();
    Notification::route('mail', $email)->notify(new OrderProcessingNotification($order, $email));

    return redirect()->route('orders.show', $order)->with('info', 'Чек об оплате был отправлен на проверку.');
}
}
