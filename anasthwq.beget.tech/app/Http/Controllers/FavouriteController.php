<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FavouriteController extends Controller

{
    public function index()
    {
        $user = auth()->user();
        $favourites = $user->favourites()->with('products')->get();
        $favouriteProductIds = $user->favourites()->with('products')->get()->pluck('products.*.id')->flatten()->toArray();
        return view('favourites', compact('favourites', 'favouriteProductIds'));
    }

    public function toggle(Request $request, $productId)
{
   $user = Auth::user();
    $favourite = $user->favourites()->firstOrCreate([]);

    if ($favourite->products()->where('product_id', $productId)->exists()) {
        $favourite->products()->detach($productId);
        $request->session()->flash('info', 'Товар был удален из избранных.');
        $request->session()->flash('action', 'removed');
    } else {
        $favourite->products()->attach($productId);
        $request->session()->flash('info', 'Товар был добавлен в избранные.');
        $request->session()->flash('action', 'added');
    }

    return response()->json([
        'info' => session('info'),
        'action' => session('action')
    ]);
}


}
