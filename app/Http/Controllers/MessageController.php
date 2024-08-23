<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Order;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchMessages(String $order_id)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            DB::table('messages')
            ->where('user_id', '!=', Auth::id())
            ->where('status', "Delivered")
            ->where('order_id', $order_id)
            ->update([
                'status'=>"Seen",
            ]);

            $currentDate = Carbon::now()->toDateString();

            $messages = DB::table('messages')
                        ->join('orders','messages.order_id','=','orders.id')
                        ->join('users','messages.user_id','=','users.id')
                        ->leftJoin('profiles','users.id','=','profiles.user_id')
                        ->where('messages.order_id', $order_id)
                        ->select('messages.*','users.first_name','users.last_name','profiles.photo','orders.status as order_status','orders.date as order_date')
                        ->orderBy('messages.created_at', 'ASC')
                        ->get();

            $order = Order::find($order_id);
            $orderDate = Carbon::createFromFormat('Y-m-d H:i:s', $order->date)->format('Y-m-d');

            return response()->json([
                'messages'=>$messages,
                'user'=>Auth::id(),
                'currentDate'=>$currentDate,
                'orderDate'=>$orderDate,
                'orderStatus'=>$order->status,
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
                'order_id'=>'required',
                'message'=>'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray,
                ]);
            }
            else{

                Message::create([
                    'order_id'=>$request->order_id,
                    'user_id'=>Auth::id(),
                    'message'=>$request->message,
                    'status'=>"Delivered",
                    'created_at'=>Carbon::now()
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Your message have been sent."
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(String $order_id)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $lastMessage = DB::table('messages')
                    ->where('order_id', $order_id)
                    ->select('id','user_id')
                    ->orderBy('created_at','DESC')
                    ->limit(1)
                    ->get();

            foreach($lastMessage as $lm)
            {
                if($lm->user_id != Auth::id())
                {
                    DB::table('messages')
                    ->where('id', $lm->id)
                    ->update([
                        'status'=>"Seen",
                    ]);


                }
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
