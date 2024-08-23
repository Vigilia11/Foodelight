<?php

namespace App\Http\Controllers;

use App\Models\Available;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Dish;

class AvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchAvailableDish(){
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $availableMeals = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->leftJoin('availables', 'dishes.id','=','availables.dish_id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Meal')
                    ->where('availables.date',$currentDate)
                    ->groupBy('id','dish','image','price','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            return response()->json([
                'availableDish'=>$availableDish,
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
        if(Auth::user()->hasRole('admin'))
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
            }else{
                $date = Carbon::now()->toDateString();

                DB::table('availables')->insert([
                    'dish_id'=>$request->dish_id,
                    'date'=>$date
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"A dish has been available."
                    //'message'=>$request->dish_id
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Available $available)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Available $available)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Available $available)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            DB::table('availables')
            ->where('id',$id)
            ->delete();

        }
    }
}
