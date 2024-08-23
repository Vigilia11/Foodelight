<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin')){

            $top4BestSellers = DB::table('dishes')
                        ->leftJoin('order_items','dishes.id','=','order_items.dish_id')
                        ->leftJoin('orders','order_items.order_id','=','orders.id')
                        ->select('dishes.id','dishes.image','dishes.dish',
                                DB::raw('sum(order_items.quantity) as totalOrder'))
                        ->groupBy('dishes.id','dishes.image','dishes.dish')
                        ->orderBy('totalOrder','DESC')
                        ->limit(4)
                        ->get();
            $top10BestSellers = DB::table('dishes')
                        ->leftJoin('order_items','dishes.id','=','order_items.dish_id')
                        ->leftJoin('orders','order_items.order_id','=','orders.id')
                        ->select('dishes.id','dishes.image','dishes.dish',
                                DB::raw('sum(order_items.quantity) as totalOrder'))
                        ->groupBy('dishes.id','dishes.image','dishes.dish')
                        ->orderBy('totalOrder','DESC')
                        ->limit(10)
                        ->get();

            $favorites= DB::table('dishes')
                        ->leftJoin('reacts','dishes.id','=','reacts.dish_id')
                        ->select('dishes.id','dishes.image','dishes.dish',
                            DB::raw('count(reacts.dish_id) as totalFavorite'))
                        ->groupBy('dishes.id','dishes.image','dishes.dish')
                        ->orderBy('totalFavorite','DESC')
                        ->limit(4)
                        ->get();
            
            $requests= DB::table('dishes')
                        ->leftJoin('dish_requests','dishes.id','=','dish_requests.dish_id')
                        ->select('dishes.id','dishes.image','dishes.dish',
                            DB::raw('count(dish_requests.dish_id) as totalRequest'))
                        ->groupBy('dishes.id','dishes.image','dishes.dish')
                        ->orderBy('totalRequest','DESC')
                        ->limit(4)
                        ->get();

            return view('home', compact('top4BestSellers','top10BestSellers','favorites','requests'));
        }
    }
}
