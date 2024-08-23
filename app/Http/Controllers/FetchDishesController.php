<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Price;


class FetchDishesController extends Controller
{
    public function fetchMeals()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $meals = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Meal')
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'meals'=>$meals,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchCakes()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $dishes = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Cake')
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'dishes'=>$dishes,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchBreads()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $dishes = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Bread')
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'dishes'=>$dishes,
                'active_user'=>$active_user,
            ]);
        }
    }
    
    public function fetchJuices()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $dishes = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Juice')
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'dishes'=>$dishes,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchCoffees()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $dishes = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Coffee')
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'dishes'=>$dishes,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchSoftDrinks()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $dishes = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Soft Drink')
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'dishes'=>$dishes,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchMilkteas()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $dishes = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','MilkTea')
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'dishes'=>$dishes,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchFruits()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $dishes = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Fruit')
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'dishes'=>$dishes,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchMostFavorites()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $meals = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->groupBy('id','dish','image')
                    ->orderBy('totalReact', 'DESC')
                    ->limit(5)
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'meals'=>$meals,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchSelectedDish($dish_id)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $meals = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image', 'dishes.category',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->groupBy('id','dish','image','price','category','userReact','userRequest')
                    ->where('dishes.id', $dish_id)
                    ->get();

            $active_user = Auth::id();
            return response()->json([
                'meal'=>$meals,
                'active_user'=>$active_user,
            ]);
        }
    }

    public function fetchMostRequested()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $meals = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->groupBy('id','dish','image')
                    ->orderBy('totalRequest', 'DESC')
                    ->limit(5)
                    ->get();
            $active_user = Auth::id();
            return response()->json([
                'meals'=>$meals,
                'active_user'=>$active_user,
            ]);
        }
    }
}
