<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AllOrdersController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('admin'))
        {
            return view('admin.allOrders');
        }
    }

    public function fetchAllUnnoticedOrders()
    {

        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->where('orders.status','Unnoticed')
                        ->get();

            return response()->json([
                'orders'=>$orders
            ]);
        }        
    }
    public function fetchAllNoticedOrders()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->where('orders.status','Noticed')
                        ->get(); 

            return response()->json([
                'orders'=>$orders
            ]);   
        }
    }

    public function fetchAllReadyOrders()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->where('orders.status','Ready')
                        ->get();

            return response()->json([
                'orders'=>$orders
            ]);   
        }
    }

    public function fetchAllShippingOrders()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->where('orders.status','Shipping')
                        ->get();

            return response()->json([
                'orders'=>$orders
            ]);   
        }
    }

    public function fetchAllRecievedOrders()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->where('orders.status','Recieved')
                        ->get();

            return response()->json([
                'orders'=>$orders
            ]);
        }

    }
}
