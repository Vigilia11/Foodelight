<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class DishRequestController extends Controller
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
        
    }

    public function addRequest(Request $request)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $validator = Validator::make($request->all(), [
                'dish_id'=>'required',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{
                $check_user_has_request = DB::table('dish_requests')
                                ->select('id')
                                ->where('user_id', Auth::id())
                                ->where('dish_id', $request->dish_id)
                                ->groupBy('id')
                                ->get('id')
                                ->count();

                if($check_user_has_request == 0){
                    DB::table('dish_requests')->insert([
                        'dish_id'=>$request->dish_id,
                        'user_id'=>Auth::id(),
                        'created_at'=>Carbon::now()
                    ]);
            
                    return response()->json([
                        'status'=>200,
                        'message'=>'Your request have been added.'
                    ]);
                }else{
                    DB::table('dish_requests')
                        ->where('dish_id', $request->dish_id)
                        ->where('user_id', Auth::id())
                        ->delete();

                    return response()->json([
                        'status'=>200,
                        'message'=>'Your request have been removed.'
                    ]);
                    
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
