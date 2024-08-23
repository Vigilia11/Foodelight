<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('user'))
        {
            /*
            $carts = DB::table('carts')
                    ->join('dishes','carts.dish_id','=','dishes.id')
                    ->join('users','carts.user_id','=','users.id')
                    ->leftJoin('sizes','carts.size_id','=','sizes.id')
                    ->where('carts.user_id', Auth::id())
                    ->select('carts.*','dishes.dish','dishes.image','sizes.size')
                    ->groupBy('carts.id','carts.dish_id','carts.user_id','carts.size_id','carts.quantity','carts.price','carts.date',
                    'dishes.dish','dishes.image','sizes.size')
                    ->orderBy('carts.date','DESC')
                    ->get();
            */
            $carts = DB::table('carts')
                    ->select('date',DB::raw('sum(quantity) as totalQuantity'), DB::raw('sum(price) as totalPrice'))
                    ->where('user_id', Auth::id())
                    ->where('carts.ordered', false)
                    ->groupBy('date')
                    ->orderBy('date','DESC')
                    ->get();

            return view('user.cart', compact('carts'));            
        }
    }
    public function fetchCarts()
    {
        if(Auth::user()->hasRole('user'))
        {
            $carts = DB::table('carts')
                    ->select('date',DB::raw('sum(quantity) as totalQuantity'), DB::raw('sum(price) as totalPrice'))
                    ->where('user_id', Auth::id())
                    ->where('carts.ordered', false)
                    ->groupBy('date')
                    ->orderBy('date','DESC')
                    ->get();

            return response()->json([
                'carts' => $carts,
            ]);
        }
    }

    public function cartItems($date)
    {
        if(Auth::user()->hasRole('user'))
        {
            /*
            $carts = DB::table('carts')
                    ->join('dishes','carts.dish_id','=','dishes.id')
                    ->join('users','carts.user_id','=','users.id')
                    ->leftJoin('sizes','carts.size_id','=','sizes.id')
                    ->where('carts.user_id', Auth::id())
                    ->where('carts.date', $date)
                    ->select('carts.*','dishes.dish','dishes.image','sizes.size')
                    ->groupBy('carts.id','carts.dish_id','carts.user_id','carts.size_id','carts.quantity','carts.price','carts.date',
                    'dishes.dish','dishes.image','sizes.size')
                    ->orderBy('carts.date','DESC')
                    ->get();
*/
            return view('user.cartItems');
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $date)
    {
        if(Auth::user()->role('user'))
        {
            DB::table('carts')
            ->where('date', $date)
            ->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Your cart have been deleted.',
            ]);
        }
    }

    public function destroyAll()
    {
        if(Auth::user()->role('user'))
        {
            DB::table('carts')
            ->where('user_id', Auth::id())
            ->delete();

            return redirect('/cart');
        }
    }
}
