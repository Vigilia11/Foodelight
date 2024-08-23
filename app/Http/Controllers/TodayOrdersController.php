<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TodayOrdersController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('admin'))
        {
            return view('admin.todayOrders');
        }
    }

    public function fetchTodayUnnoticedOrders()
    {

        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->whereDate('orders.date', Carbon::today()->toDateString())
                        ->where('orders.status','Unnoticed')
                        ->get();

            return response()->json([
                'orders'=>$orders
            ]);
        }        
    }
    public function fetchTodayNoticedOrders()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->whereDate('orders.date', Carbon::today()->toDateString())
                        ->where('orders.status','Noticed')
                        ->get(); 

            return response()->json([
                'orders'=>$orders
            ]);   
        }
    }

    public function fetchTodayReadyOrders()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->whereDate('orders.date', Carbon::today()->toDateString())
                        ->where('orders.status','Ready')
                        ->get();

            return response()->json([
                'orders'=>$orders
            ]);   
        }
    }

    public function fetchTodayShippingOrders()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->whereDate('orders.date', Carbon::today()->toDateString())
                        ->where('orders.status','Shipping')
                        ->get();

            return response()->json([
                'orders'=>$orders
            ]);   
        }
    }

    public function fetchTodayRecievedOrders()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $orders = DB::table('orders')
                        ->join('users','orders.user_id','=','users.id')
                        ->select('orders.id','orders.date','orders.status','users.first_name','users.last_name')
                        ->orderBy('orders.date','ASC')
                        ->whereDate('orders.date', Carbon::today()->toDateString())
                        ->where('orders.status','Recieved')
                        ->get();

            return response()->json([
                'orders'=>$orders
            ]);
        }

    }
}
