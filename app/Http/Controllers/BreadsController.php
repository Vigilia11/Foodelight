<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Price;
use App\Models\Dish;

class BreadsController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('user'))
        {
            return view('user.breads');
            
        }
        if(Auth::user()->hasRole('admin'))
        {
            return view('admin.breads');            
        }
    }

    public function fetchBreads(){
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $breads = DB::table('dishes')
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

            $available = DB::table('dishes')
                    ->join('availables','dishes.id','=','availables.dish_id')
                    ->select('availables.*')
                    ->get();

            $active_user = Auth::id();
            return response()->json([
                'breads'=>$breads,
                'active_user'=>$active_user,
                'currentDate'=>$currentDate,
                'available'=>$available,
            ]);
        }
    }

    public function filterBreads($filter){
        
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $dishes;
            switch($filter){
                case('name'):
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
                    break;
                case ("price"):
                        $dishes = DB::table('dishes')
                                ->join('prices','prices.dish_id','=','dishes.id')
                                ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                                ->leftJoin('users','users.id','=','reacts.user_id')
                                ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                                ->leftJoin('availables','dishes.id','=','availables.dish_id')
                                ->select('dishes.id','dishes.dish','dishes.image',
                                        'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                                        DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                                ->where('dishes.category','Bread')
                                ->groupBy('id','dish','image','price','userReact','userRequest')
                                ->orderBy('price', 'ASC')
                                ->get();
                        break;
                default:
                $dishes= DB::table('dishes')
                        ->join('prices','prices.dish_id','=','dishes.id')
                        ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                        ->leftJoin('users','users.id','=','reacts.user_id')
                        ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                        ->select('dishes.id','dishes.dish','dishes.image', 'dishes.created_at',
                                'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                                DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                        ->where('dishes.category','Bread')
                        ->groupBy('id','dish','image','price','userReact','userRequest', 'created_at','available_date')
                        ->orderBy('created_at', 'DESC')
                        ->get();
            }

            $available = DB::table('dishes')
                    ->join('availables','dishes.id','=','availables.dish_id')
                    ->select('availables.*')
                    ->get();
            
            $active_user = Auth::id();
            return response()->json([
                'dishes'=>$dishes,
                'active_user'=>$active_user,
                'currentDate'=>$currentDate,
                'available'=>$available,
            ]);
            
        }
    }

    public function fetchAvailableBreads()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $availables = DB::table('dishes')
                            ->join('availables','dishes.id','=','availables.dish_id')
                            ->where('availables.date',$currentDate)
                            ->where('dishes.category',"Bread")
                            ->select('dishes.*')
                            ->get();

            return response()->json([
                'availables' => $availables,
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
                'image'=>'required|image',
                'name' => 'required|string',
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
                        'category' =>"Bread",
                        'image' =>$filename,
                        'created_at' =>Carbon::now()
                    ]);
    
                    Price::create([
                        'dish_id'=>$dish_id,
                        'price'=>$request->price,
                        'created_at' =>Carbon::now()
                    ]);
    
                    DB::commit();
                    
                    return response()->json([
                        'status'=>200,
                        'message'=>"Your bread have been added."
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
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('user'))
        {
            $currentDate = Carbon::now()->toDateString();

            $bread = DB::table('dishes')
                    ->join('prices','prices.dish_id','=','dishes.id')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->leftJoin('availables', 'dishes.id','=','availables.dish_id')
                    ->select('dishes.id','dishes.dish','dishes.image', 'dishes.category',
                            'prices.price','reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            'availables.id as available_id','availables.date as available_date',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->groupBy('id','dish','image','price','category','userReact','userRequest','available_id','available_date')
                    ->where('dishes.id', $id)
                    ->get();

            return response()->json([
                'bread'=>$bread,
                'currentDate'=>$currentDate,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $dish_id)
    {
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [                
                'name' => 'required|string',
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

                    DB::table('dishes')
                    ->where('id', $dish_id)
                    ->update([
                        'dish'=>$request->name
                    ]);
    
                    DB::table('prices')
                    ->where('dish_id', $dish_id)
                    ->update([
                        'price'=>$request->price
                    ]);
    
                    DB::commit();
                    
                    return response()->json([
                        'status'=>200,
                        'message'=>"Your meal have been updated."
                    ]);

                    
                }catch(exception $e){
                    throw $e;
                    DB::rollback();
                }
            }
        }
    }

    public function updateMeal(Request $request, $dish_id)
    {
        //'dish_id' => 'required',
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [                
                'name' => 'required|string',
                'price' => 'required',
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

                    DB::table('dishes')
                    ->where('id', $dish_id)
                    ->update([
                        'dish'=>$request->name
                    ]);
    
                    DB::table('prices')
                    ->where('dish_id', $dish_id)
                    ->update([
                        'price'=>$request->price
                    ]);
    
                    DB::commit();
                    
                    return response()->json([
                        'status'=>200,
                        'message'=>"Your meal have been updated."
                    ]);

                    
                }catch(exception $e){
                    throw $e;
                    DB::rollback();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
