<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $order = Auth::user()->orders()->firstWhere('status', 'В корзине');
        $totalPrice = 0; // Инициализация переменной для общей суммы

        if ($order) {
            foreach ($order->products as $product) {
                $totalPrice += $product->pivot->qty * $product->price; // Вычисление общей суммы
            }
        }

        $totalPrice += 350; // Добавление 350 к общей сумме

        return view('cart', ['products' => $order ? $order->products : [], 'totalPrice' => $totalPrice]);
    }

    public function store($product_id) {
        $order = Auth::user()->orders()->firstWhere('status', 'В корзине');
        if ($order) {
            $product = $order->products()->find($product_id);

            if($product) {
                $qty = $product->pivot->qty + 1;
                $order->products()->updateExistingPivot($product_id, ['qty'=>$qty]);
            } else {
                $order->products()->attach($product_id, ['qty'=>1]);
            }
            return redirect()->back()->with('info', 'Вы добавили товар в корзину.');
        } else {
            return redirect()->back()->with('error', 'Ошибка: товар не найден.');
        }
    }


    public function change(Request $request, $product_id) {
        $order = Auth::user()->orders()->firstWhere('status', 'В корзине');
        $order->products()->updateExistingPivot($product_id, ['qty'=>$request->qty]);

        return redirect()->route('cart.index')->with('info', 'Количество товара изменено.');

    }

    public function destroy($id) {
        $order = Auth::user()->orders()->firstWhere('status', 'В корзине');
        $order->products()->detach($id);
        return redirect()->route('cart.index')->with('info', 'Товар удален из корзины.');
    }
}
