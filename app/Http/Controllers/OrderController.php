<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('user'))
        {            
            return view('user.order');
        }
    }

    public function fetchOrders(){
        if(Auth::user()->hasRole('user'))
        {
            $orders = DB::table('orders')
                    ->join('order_items','orders.id','=','order_items.order_id')
                    ->where('orders.user_id',Auth::id())
                    ->select('orders.*',
                            DB::raw('sum(order_items.price) as totalPrice'), DB::raw('sum(order_items.quantity) as totalQuantity'))
                    ->groupBy('orders.id','orders.date','orders.user_id','orders.status',)
                    ->orderBy('orders.date','DESC')
                    ->get();

            return response()->json([
                'orders'=>$orders
            ]);
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
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $validator = Validator::make($request->all(), [
                'dish_id'=>'required',
                'quantity'=>'required|integer'
            ]);
            if($validator->fails()){
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }else{
                DB::table('orders')->insert([
                    'dish_id'=>$request->dish_id,
                    'user_id'=>Auth::id(),
                    'size_id'=>$request->size_id,
                    'quantity'=>$request->quantity,
                    'date'=>Carbon::now(),
                    'status'=>"Unnoticed",
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Your order created successfully.",
                ]);
            }
        }
    }

    public function cartToOrder(Request $request)
    {
        if(Auth::user()->hasRole('user'))
        {           
            $request->validate([
                'cartDate' => ['required'],
                'recieve_order_method' => ['required'],
            ]);

                $carts = DB::table('carts')
                    ->join('dishes','carts.dish_id','=','dishes.id')
                    ->join('users','carts.user_id','=','users.id')
                    ->leftJoin('sizes','carts.size_id','=','sizes.id')
                    ->where('carts.user_id', Auth::id())
                    ->where('carts.date', $request->cartDate)
                    ->where('carts.ordered', false)
                    ->select('carts.*','dishes.dish','dishes.image','sizes.size')
                    ->orderBy('carts.id','ASC')
                    ->get();
            /*
                return response()->json([
                    'carts'=>$carts
                ]);
                */
                
                try{
                    DB::beginTransaction();

                    $order_id = DB::table('orders')->insertGetId([
                        'user_id'=>Auth::id(),
                        'date'=>Carbon::now(),
                        'status'=>'Unnoticed',
                    ]);
                    $currentDateTime = Carbon::now();
                    foreach($carts as $cart)
                    {
                        DB::table('order_items')->insert([
                            'order_id'=>$order_id,
                            'dish_id'=>$cart->dish_id,
                            'size_id'=>$cart->size_id,                            
                            'quantity'=>$cart->quantity,
                            'price'=>$cart->price,
                            'created_at'=>$currentDateTime,
                        ]);

                        DB::table('carts')
                        ->where('id',$cart->id)
                        ->update([
                            'ordered'=>true,
                        ]);
                    }

                    DB::table('pickup_order_method')->insert([
                        'order_id'=>$order_id,
                        'method'=>$request->recieve_order_method,
                        'created_at'=>Carbon::now(),
                    ]);

                    DB::commit();

                    return redirect('/order');
                }
                catch(exception $e){
                    throw $e;
                    DB::rollback();
                }
                
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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

    public function update(String $id,Request $request)
    {
        if(Auth::user()->hasRole('admin'))
        {
            DB::table('orders')
            ->where('id', $id)
            ->update([
                'status'=>$request->status
            ]);

            return redirect('/ordersToday');
        }

        if(Auth::user()->hasRole('user'))
        {
            DB::table('orders')
            ->where('id', $id)
            ->update([
                'status'=>$request->status
            ]);

            return redirect('/order');
        }
    }

    public function cancelOrder(String $id)
    {
        if(Auth::user()->hasRole('user'))
        {
            DB::table('orders')
            ->where('id', $id)
            ->update([
                'status'=>"Canceled"
            ]);

            return response()->json([
                'status'=>200,
                'message'=>"Your order have been canceled.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        if(Auth::user()->hasRole('user'))
        {
            DB::table('orders')
            ->where('id', $id)
            ->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Your order have been deleted.',
            ]);
        }
    }

    public function destroyAll()
    {
        if(Auth::user()->hasRole('user'))
        {
            DB::table('orders')
            ->where('user_id', Auth::id())
            ->delete();

            return redirect('/order');
        }
    }
}
