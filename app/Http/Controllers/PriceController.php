<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Dish;
use App\Models\Size;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchDishPrice($dish_id){
        if(Auth::user()->hasRole('user')){
            $dish = DB::table('dishes')
                    ->join('prices','dishes.id','=','prices.dish_id')
                    ->select('dishes.*','prices.price')
                    ->where('dishes.id',$dish_id)
                    ->get();
            
            return response()->json([
                'dish'=>$dish,
            ]);            
        }
    }

    public function fetchDrinkPrice($size_id){
        if(Auth::user()->hasRole('user')){
            /*
            $dish = DB::table('dishes')
                    ->join('sizes','dishes.id','=','sizes.dish_id')
                    ->join('prices','sizes.id','=','prices.size_id')
                    ->select('dishes.*','sizes.size','prices.price')
                    ->where('sizes.id',$size_id)
                    ->get();
            */

            $dish = DB::table('sizes')
                    ->join('prices','sizes.id','=','prices.size_id')
                    ->where('prices.size_id',$size_id)
                    ->select('sizes.*','prices.price')
                    ->get();

            return response()->json([
                'dish'=>$dish,
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
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'dish_id'=>'required|string',
                'size' => 'required|string',
                'price' => 'required|integer',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{

                try{
                    DB::beginTransaction();

                    $size_id = DB::table('sizes')->insertGetId([
                        'dish_id'=>$request->dish_id,
                        'size'=>$request->size,
                        'created_at'=>Carbon::now()
                    ]);

                    Price::create([
                        'dish_id'=>$request->dish_id,
                        'size_id'=>$size_id,
                        'price'=>$request->price,
                        'created_at' =>Carbon::now()
                    ]);
    
                    DB::commit();

                    return response()->json([
                        'status'=>200,
                        'message'=>'A price have been added successfully.',
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
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'price' => 'required|integer',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{
                DB::table('prices')
                ->where('id', $id)
                ->update([
                    'price'=>$request->price,
                    'updated_at'=>Carbon::now(),
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>'Price has been updated.'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($size_id)
    {
        if(Auth::user()->hasRole('admin')){
            Size::find($size_id)->delete();
        }

        return response()->json([
            'status'=>200,
            'message'=>'Price has been deleted.'
        ]);
    }
}
