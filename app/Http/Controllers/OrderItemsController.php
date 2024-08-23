<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Order;

class OrderItemsController extends Controller
{
    public function OrderItems(string $id)
    {
        if(Auth::user()->hasRole('user'))
        {
            $order_id = $id;

            $order = Order::find($id);

            return view('user.orderItems', compact('order_id','order'));
        }

        if(Auth::user()->hasRole('admin'))
        {
            $order_id = $id;

            //$order = DB::table('orders')->where('id',$id)->get();

            $order = Order::find($id);
            if($order->status == "Unnoticed")
            {
                DB::table('orders')
                ->where('id',$id)
                ->update([
                    'status'=>'Noticed'
                ]);

            }

            return view('admin.order', compact('order_id'));
        }
    }

    public function fetchOrderItems($id)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $orders = DB::table('orders')
                    ->join('order_items','orders.id','=','order_items.order_id')
                    ->join('dishes','order_items.dish_id','=','dishes.id')
                    ->leftJoin('sizes','order_items.size_id','=','sizes.id')
                    ->join('pickup_order_method','orders.id','=','pickup_order_method.order_id')
                    //->where('orders.user_id', Auth::id())
                    ->where('orders.id', $id)
                    ->select('orders.date','orders.status',
                            'order_items.*','dishes.dish','dishes.image','sizes.size',
                            'pickup_order_method.method'
                        )
                    ->orderBy('orders.date','ASC')
                    ->get();
                    
            $order = DB::table('orders')
                    ->join('pickup_order_method','orders.id','=','pickup_order_method.order_id')
                    ->where('order_id',$id)
                    ->select('orders.status','pickup_order_method.*')
                    ->get();
            
            $message = DB::table('messages')
                    ->where('order_id', $id)
                    ->select(DB::raw('count(id) as totalMessages'), 'status')
                    ->groupBy('status')
                    ->get();

            return response()->json([
                'orders'=>$orders,
                'currentDate'=>$currentDate,
                'order'=>$order,
            ]);
        }
    }
    public function deleteOrderItem(string $id)
    {
        if(Auth::user()->hasRole('user'))
        {
            DB::table('order_items')
            ->where('id', $id)
            ->delete();

            return response()->json([
                'status'=>200,
                'message'=>"Your order item have deleted.",
            ]);
        }
    }

    public function fetchOrderItem($id)
    {
        if(Auth::user()->hasRole('user'))
        {
            $order = DB::table('order_items')
                    ->join('dishes','order_items.dish_id','=','dishes.id')
                    ->where('order_items.id', $id)
                    ->select('order_items.*','dishes.dish','dishes.image', 'dishes.category')
                    ->get();
            
            $sizes ="";
            foreach($order as $item)
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
                'order'=>$order,
                'sizes'=>$sizes,
            ]);
        }
    }

    public function updateDishOrder(Request $request)
    {
        if(Auth::user()->hasRole('user'))
        {
            $validator = Validator::make($request->all(), [
                'order_item_id'=>'required',
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
                DB::table('order_items')
                ->where('id', $request->order_item_id)
                ->update([
                    'quantity'=>$request->quantity,
                    'price'=>$request->price
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Your order have been updated.",
                ]);
            }
        }
    }

    public function updateDrinkOrder(Request $request)
    {
        if(Auth::user()->hasRole('user'))
        {
            $validator = Validator::make($request->all(), [
                'order_item_id'=>'required',
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
                DB::table('order_items')
                ->where('id', $request->order_item_id)
                ->update([
                    'size_id'=>$request->size,
                    'quantity'=>$request->quantity,
                    'price'=>$request->price
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Your order have been updated.",
                ]);
            }
        }
    }

    
}
