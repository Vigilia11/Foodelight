<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Price;
use App\Models\Dish;
use App\Models\Size;

class MilkteaController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('user'))
        {
            return view('user.milktea');
            
        }
        if(Auth::user()->hasRole('admin'))
        {

            return view('admin.milktea');            
        }
    }

    public function fetchMilktea(){
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $milktea = DB::table('dishes')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.category','Milktea')
                    ->groupBy('id','dish','image','userReact','userRequest')
                    ->orderBy('dish', 'ASC')
                    ->get();
            $prices = DB::table('dishes')
                    ->join('sizes', 'dishes.id','=','sizes.dish_id')
                    ->join('prices', 'sizes.id', '=', 'prices.size_id')
                    ->select('dishes.id as dish_id', 'sizes.id as size_id','sizes.size', 'prices.id as price_id', 'prices.price')
                    ->orderBy('sizes.size', 'DESC')
                    ->get();
            $available = DB::table('dishes')
                    ->join('availables','dishes.id','=','availables.dish_id')
                    ->select('availables.*')
                    ->get();
            
            $active_user = Auth::id();
            return response()->json([
                'milktea'=>$milktea,
                'prices'=>$prices,
                'active_user'=>$active_user,
                'currentDate'=>$currentDate,
                'available'=>$available,
            ]);
        }
    }

    public function filterMilktea($filter){
        
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $milktea;
            switch($filter){
                case('name'):
                    $milktea = DB::table('dishes')
                        ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                        ->leftJoin('users','users.id','=','reacts.user_id')
                        ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                        ->select('dishes.id','dishes.dish','dishes.image',
                                'reacts.user_id as userReact','dish_requests.user_id as userRequest',
                                DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                        ->where('dishes.category','milktea')
                        ->groupBy('id','dish','image','userReact','userRequest')
                        ->orderBy('dish', 'ASC')
                        ->get();
                    break;
                default:
                    $milktea = DB::table('dishes')
                        ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                        ->leftJoin('users','users.id','=','reacts.user_id')
                        ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                        ->select('dishes.id','dishes.dish','dishes.image',
                                'reacts.user_id as userReact','dish_requests.user_id as userRequest',
                                DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                        ->where('dishes.category','milktea')
                        ->groupBy('id','dish','image','userReact','userRequest')
                        ->orderBy('dishes.created_at', 'DESC')
                        ->get();
                    
            }
            $prices = DB::table('dishes')
                    ->join('sizes', 'dishes.id','=','sizes.dish_id')
                    ->join('prices', 'sizes.id', '=', 'prices.size_id')
                    ->select('dishes.id as dish_id', 'sizes.id as size_id','sizes.size', 'prices.id as price_id', 'prices.price')
                    ->orderBy('sizes.size', 'DESC')
                    ->get();

            $available = DB::table('dishes')
                    ->join('availables','dishes.id','=','availables.dish_id')
                    ->select('availables.*')
                    ->get();
            
            $active_user = Auth::id();
            return response()->json([
                'milktea'=>$milktea,
                'prices'=>$prices,
                'active_user'=>$active_user,
                'currentDate'=>$currentDate,
                'available'=>$available,
            ]);
            
        }
    }

    public function fetchMilkteaById($id){
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('user')){
            $currentDate = Carbon::now()->toDateString();

            $milktea = DB::table('dishes')
                    ->leftJoin('reacts','reacts.dish_id','=','dishes.id')
                    ->leftJoin('users','users.id','=','reacts.user_id')
                    ->leftJoin('dish_requests','dish_requests.dish_id','=','dishes.id')
                    ->select('dishes.id','dishes.dish','dishes.image',
                            'reacts.user_id as userReact','dish_requests.user_id as userRequest',
                            DB::raw('count(reacts.id) as totalReact'), DB::raw('count(dish_requests.id) as totalRequest'))
                    ->where('dishes.id',$id)
                    ->groupBy('id','dish','image','userReact','userRequest')
                    ->get();
            
            $prices;
            $availableDate;
            foreach($milktea as $drink)
            {
                $prices = DB::table('dishes')
                    ->join('sizes', 'dishes.id','=','sizes.dish_id')
                    ->join('prices', 'sizes.id', '=', 'prices.size_id')
                    ->select('dishes.id as dish_id', 'sizes.id as size_id','sizes.size', 'prices.id as price_id', 'prices.price')
                    ->where('dishes.id', $drink->id)
                    ->get();

                $availableDate = DB::table('dishes')
                    ->join('availables', 'dishes.id','=','availables.dish_id')
                    ->where('dishes.id', $drink->id)
                    ->select('availables.id as availble_id','availables.date')
                    ->get();
                            
            }
            
            $available = DB::table('availables')
                        ->where('dish_id',$id)
                        ->where('date',$currentDate)
                        ->get();
            
            $active_user = Auth::id();
            return response()->json([
                'milktea'=>$milktea,
                'prices'=>$prices,
                'active_user'=>$active_user,
                'currentDate'=>$currentDate,
                'availableDate'=>$availableDate,
                'available'=>$available,
            ]);
        }
    }

    public function fetchAvailableMilkteas()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $availables = DB::table('dishes')
                            ->join('availables','dishes.id','=','availables.dish_id')
                            ->where('availables.date',$currentDate)
                            ->where('dishes.category',"milktea")
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
                        'category' =>"milktea",
                        'image' =>$filename,
                        'created_at' =>Carbon::now()
                    ]);

                    $size_id = DB::table('sizes')->insertGetId([
                        'dish_id'=>$dish_id,
                        'size'=>$request->size,
                        'created_at'=>Carbon::now()
                    ]); 
    
                    Price::create([
                        'dish_id'=>$dish_id,
                        'size_id'=>$size_id,
                        'price'=>$request->price,
                        'created_at' =>Carbon::now()
                    ]);
    
                    DB::commit();
                    
                    return response()->json([
                        'status'=>200,
                        'message'=>"Your milktea have been added."
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
        if(Auth::user()->hasRole('admin'))
        {
            $currentDate = Carbon::now()->toDateString();

            $milktea = DB::table('dishes')
                    ->select('*')
                    ->where('dishes.id', $id)
                    ->get();

            return response()->json([
                'milktea'=>$milktea,
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
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray()
                ]);
            }
            else{
                                
                DB::table('dishes')
                ->where('id', $dish_id)
                ->update([
                    'dish'=>$request->name
                ]);
                    
                return response()->json([
                    'status'=>200,
                    'message'=>"Your milktea have been updated."
                ]);
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
