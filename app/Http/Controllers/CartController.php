<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Carts;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cat;
    public function __construct()
    {
        $this->cat = new Categories();
    }
    public function index()
    {
        $id_user = Session::get('user')->id;
        $cart = Carts::where('id_user', $id_user)->orderBy('id', 'desc')->get();
        $categories = $this->cat->queryCat();
        return view('Clients.contents.cart', compact('cart', 'categories'));
    }
    public function addToCart(Request $request)
    {
        $id_user = $request->input('id_user');
        $id_product = $request->input('id');
        $cartItem = Carts::where('id_user', $id_user)
            ->where('id_product', $id_product)
            ->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->total = $cartItem->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            // Tính toán giá trị total
            $total = $request->price * $request->quantity;

            // Lưu thông tin vào bảng Carts
            Carts::create([
                'id_user' => $id_user,
                'id_product' => $request->id,
                'name_product' => $request->name,
                'img' => $request->img,
                'price' => $request->price,
                'total' => $total, // Sử dụng giá trị total đã tính toán
                'quantity' => $request->quantity,
            ]);
        }
        return redirect()->route('cart');
    }
    public function decreaseCart(Request $request)
    {
        $idProduct = $request->input('id');
        $id_user = $request->input('id_user');
        $cartItem = Carts::where('id', $idProduct)
            ->where('id_user', $id_user)
            ->first();
        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
                $cartItem->total = $cartItem->price * $cartItem->quantity;
                $cartItem->save();
            }
        }
        return redirect()->route('cart');
    }
    public function increaseCart(Request $request)
    {
        $idProduct = $request->input('id');
        $id_user = $request->input('id_user');
        $cartItem = Carts::where('id', $idProduct)
            ->where('id_user', $id_user)
            ->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->total = $cartItem->price * $cartItem->quantity;
            $cartItem->save();
        }
        return redirect()->route('cart');
    }

    public function removeCart(Request $request)
    {
        $idProduct = $request->input('id');
        $id_user = $request->input('id_user');
        $cartItem = Carts::where('id', $idProduct)
            ->where('id_user', $id_user)
            ->first();
        if ($cartItem) {
            $cartItem->delete();
        }
        return redirect()->route('cart');
    }
    public function removeallCart(Request $request)
    {
        $id_user = $request->input('id_user');

        // Delete all cart records for the specified user
        Carts::where('id_user', $id_user)->delete();

        return redirect()->route('cart');
    }
}
