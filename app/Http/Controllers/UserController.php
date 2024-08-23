<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{
    public function index(String $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
                    
            $user_id = $id;

            return view('admin.user', compact('user_id'));
        }
    }

    public function fetchUser(String $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
                    
            $user = DB::table('users')
                    ->leftJoin('profiles','users.id','=','profiles.user_id')
                    ->select('users.*','profiles.mobile_number','profiles.photo','profiles.street','profiles.barangay','profiles.city','profiles.province')
                    ->where('users.id',$id)
                    ->get();

            $order = DB::table('orders')
                    ->join('order_items','orders.id','=','order_items.order_id')
                    ->where('orders.user_id', $id)
                    ->where('orders.status', "Received")
                    ->select(DB::raw('count(orders.id) as totalOrder'), 
                            DB::raw('sum(order_items.quantity) as totalOrderItem'),
                            DB::raw('sum(order_items.price) as totalPrice'))
                    ->get();

            return response()->json([
                'user'=>$user,
                'order'=>$order,
            ]);
        }
    }

    public function blockUser(String $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'account_status'=>"Blocked",
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"This account has been blocked",
                ]);
            
        }
    }

    public function setUserActive(String $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'account_status'=>"Active",
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"This account are now active.",
                ]);
            
        }
    }
}
