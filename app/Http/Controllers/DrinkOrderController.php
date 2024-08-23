<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class DrinkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        if(Auth::user()->hasRole('user'))
        {
            $validator = Validator::make($request->all(), [
                'dish_id'=>'required',
                'size'=>'required',
                'quantity'=>'required|integer',
                'price'=>'required',
                'recieve_method'=>'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else{
                try{
                    DB::beginTransaction();

                    $order_id = DB::table('orders')->insertGetId([
                        'user_id'=>Auth::id(),
                        'date'=>Carbon::now(),
                        'status'=>"Unnoticed",
                    ]);

                    DB::table('order_items')->insert([
                        'order_id'=>$order_id,
                        'dish_id'=>$request->dish_id,
                        'size_id'=>$request->size,
                        'quantity'=>$request->quantity,
                        'price'=>$request->price,
                        'created_at'=>Carbon::now(),
                    ]);

                    DB::table('pickup_order_method')->insert([
                        'order_id'=>$order_id,
                        'method'=>$request->recieve_method,
                        'created_at'=>Carbon::now(),
                    ]);

                    DB::commit();

                    return response()->json([
                        'status'=>200,
                        'message'=>"Your order have been submitted."
                    ]);
                }catch(exception $e){
                    throw $e;
                    DB::rollback();
                }
            }
        }
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
    public function destroy(string $id)
    {
        //
    }
}
