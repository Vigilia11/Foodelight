<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class DishCartController extends Controller
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
                'quantity'=>'required|integer',
                'price'=>'required|integer',
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

                    $date = Carbon::today()->toDateString();
                    DB::table('carts')->insert([
                        'user_id'=>Auth::id(),
                        'dish_id'=>$request->dish_id,
                        'quantity'=>$request->quantity,
                        'price'=>$request->price,
                        'date'=>$date,
                        'ordered'=>false,
                    ]);

                    DB::commit();

                    return response()->json([
                        'status'=>200,
                        'message'=>"Your order have been added to your cart."
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
