<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use JWTAuth;
use TymonJWTAuthExceptionsJWTException;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Get profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $result['name'] = $user->name;
        $result['email'] = $user->email;
        $result['roles'] = $user->roles->pluck('name');

        return response()->json($result);
    }

    /**
     * Get inventory.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventory()
    {
        $user = Auth::user();

        $stocks = $user->inventories()->with('stock')->get();
        $result = array();
        foreach ($stocks as $stock) {
            $result[] = [
                'symbol' => $stock->stock->symbol,
                'quantity' => $stock->quantity,
            ];
        }

        return response()->json($result);
    }

    /**
     * Get account.
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        $user = Auth::user();
        $result = [
            'balance' => $user->account->balance
        ];
        return response()->json($result);
    }

    /**
     * Get orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $user = Auth::user();

        $orders = $user->orders;
        $result = [];
        foreach ($orders as $order) {
            $result[] = [
                'id' => $order->id,
                'symbol' => $order->stock->symbol,
                'side' => $order->side,
                'price' => $order->price,
                'quantity' => $order->quantity,
                'order' => $order->order,
                'time' => $order->created_at->toDateTimeString()
            ];
        };

        return response()->json($result);
    }
}
