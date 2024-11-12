<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function regForm() {
        return view('registration');
    }

    public function register(Request $request) {

        $request->validate([
            'login' => ['regex:/^[A-Za-z0-9- ]+$/u', 'required', 'unique:users'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = new User;

        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        $order = new Order;
        $order->user_id = $user->id;
        $order->save();

        $favourite = new Favourite;
        $favourite->user_id = $user->id;
        $favourite->save();

        return redirect('/login');
    }

    public function loginForm() {
        return view('login');
    }

public function login(Request $request) {
    $credentials = $request->validate([
        'login_or_email' => ['required'],
        'password' => ['required'],
    ]);

    $fieldType = filter_var($credentials['login_or_email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

    $user = User::where($fieldType, $credentials['login_or_email'])->first();

    if ($user) {
        if (Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            if ($user->is_admin) {
                return redirect()->route('admin')->with('info', 'Вы успешно вошли в панель администратора.');
            } else {
                return redirect('/')->with('info', 'Вы успешно вошли.');
            }
        }
    }

    return back()->withErrors([
        'login_or_email' => 'Не совпали данные',
    ])->onlyInput('login_or_email');
}

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
