<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Price;
use App\Models\Dish;
use App\Models\Sizes;

class DrinksController extends Controller
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
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'image'=>'required|image',
                'name' => 'required|string',
                'category' => 'required|string',
                'price' => 'required|integer',
                'size' => 'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                //$name = $request->file('image')->getClientOriginalName(); 
                $name = $file->getClientOriginalName(); 
                //$filename = $name . time() . '.' . $extension;
                $filename = $request->name . time() . '.' . $extension;
                $file->move('images/dishes/', $filename);
                                
                try{
                    DB::beginTransaction();

                    $dish_id = DB::table('dishes')->insertGetId([
                        'dish' =>$request->name,
                        'category' =>$request->category,
                        'image' =>$filename,
                        'created_at' =>Carbon::now()
                    ]);
    
                    Price::create([
                        'dish_id'=>$dish_id,
                        'whole'=>$request->whole_price,
                        'per_order'=>$request->price_per_order,
                        'created_at' =>Carbon::now()
                    ]);
    
                    DB::commit();
                    
                    return response()->json([
                        'status'=>200,
                        'message'=>"A dish added successfully."
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
