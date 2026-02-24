<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegister()
    {
        return view('users.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|min:10',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        return redirect()->route('users.login')->with('success','Account created successfully');
    }

    public function showLogin()
    {
        return view('users.login');
    }

    public function login(Request $request, User $user)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Email or password incorrect'
            ], 401);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {

            $cart = Cart::firstOrCreate([
                'user_id' => $user->id
            ]);

            foreach ($sessionCart as $productId => $item) {

                $existing = CartItem::where([
                    'cart_id' => $cart->id,
                    'product_id' => $productId
                ])->first();

                if ($existing) {
                    $existing->increment('quantity', $item['quantity']);
                } else {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity']
                    ]);
                }
            }

            session()->forget('cart');
        }

        if ($user->role === 'owner') {
            return redirect()->route('dashboards.index')->with('success','Login successfully');
        }

        return redirect()->route('home')->with('success','Login successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('users.login')->with('success','Logout successfully');
    }
}
