<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class CartItemsController extends Controller
{
    public function cartItems($date)
    {
        if(Auth::user()->hasRole('user'))
        {
            $cartDate = $date;
            
            $carts = DB::table('carts')
                    ->join('dishes','carts.dish_id','=','dishes.id')
                    ->join('users','carts.user_id','=','users.id')
                    ->leftJoin('sizes','carts.size_id','=','sizes.id')
                    ->where('carts.user_id', Auth::id())
                    ->where('carts.date', $date)
                    ->where('carts.ordered', false)
                    ->select('carts.*','dishes.dish','dishes.image', 'dishes.category','sizes.size',
                            DB::raw('sum(carts.price) as totalPrice'))
                    ->groupBy('carts.id','carts.dish_id','carts.user_id','carts.size_id','carts.quantity','carts.price','carts.date','carts.ordered',
                    'dishes.dish','dishes.image', 'dishes.category','sizes.size')
                    ->orderBy('carts.date','DESC')
                    ->get();

            return view('user.cartItems', compact('cartDate','carts'));
        }
    }

    public function fetchCartItems($date)
    {
        if(Auth::user()->hasRole('user'))
        {
            $currentDate = Carbon::now()->toDateString();

            $carts = DB::table('carts')
                    ->join('dishes','carts.dish_id','=','dishes.id')
                    ->join('users','carts.user_id','=','users.id')
                    ->leftJoin('sizes','carts.size_id','=','sizes.id')
                    ->where('carts.user_id', Auth::id())
                    ->where('carts.date', $date)
                    ->where('carts.ordered', false)
                    ->select('carts.*','dishes.dish','dishes.image','sizes.size',
                    DB::raw('sum(carts.price) as totalPrice'))
                    ->groupBy('carts.id','carts.dish_id','carts.user_id','carts.size_id','carts.quantity','carts.price','carts.date','carts.ordered',
                    'dishes.dish','dishes.image','sizes.size')
                    ->orderBy('carts.date','DESC')
                    ->get();

            return response()->json([
                'carts'=>$carts,
                'currentDate'=>$currentDate,
            ]);
        }
    }

    public function fetchCartItem($cart_id)
    {
        if(Auth::user()->hasRole('user'))
        {
            $cart = DB::table('carts')
                    ->join('dishes','carts.dish_id','=','dishes.id')
                    ->where('carts.id', $cart_id)
                    ->select('carts.*','dishes.dish','dishes.image', 'dishes.category')
                    ->get();
            
            $sizes ="";
            foreach($cart as $item)
            {
                if($item->category == "Juice" || $item->category == "milktea")
                {
                    $sizes = DB::table('sizes')
                        ->where('dish_id',$item->dish_id)
                        ->select('sizes.*')
                        ->get();
                }
            }

            return response()->json([
                'cart'=>$cart,
                'sizes'=>$sizes,
            ]);
        }
    }

    public function updateDishCart(Request $request)
    {
        if(Auth::user()->hasRole('user'))
        {
            $validator = Validator::make($request->all(), [
                'cart_id'=>'required',
                'quantity'=>'required|integer',
                'price'=>'required|integer',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else
            {
                DB::table('carts')
                ->where('id', $request->cart_id)
                ->update([
                    'quantity'=>$request->quantity,
                    'price'=>$request->price
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Your cart have been updated.",
                ]);
            }
        }
    }

    public function updateDrinkCart(Request $request)
    {
        if(Auth::user()->hasRole('user'))
        {
            $validator = Validator::make($request->all(), [
                'cart_id'=>'required',
                'size'=>'required',
                'quantity'=>'required|integer',
                'price'=>'required|integer',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else
            {
                DB::table('carts')
                ->where('id', $request->cart_id)
                ->update([
                    'size_id'=>$request->size,
                    'quantity'=>$request->quantity,
                    'price'=>$request->price
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Your cart have been updated.",
                ]);
            }
        }
    }

    public function deleteCartItem(string $cart_id)
    {
        if(Auth::user()->hasRole('user'))
        {
            DB::table('carts')
            ->where('id', $cart_id)
            ->delete();

            return response()->json([
                'status'=>200,
                'message'=>"Your cart item have deleted.",
            ]);
        }
    }
}
