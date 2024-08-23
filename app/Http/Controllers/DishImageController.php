<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use App\Models\Dish;

class DishImageController extends Controller
{
    public function updateDishImage(Request $request)
    {
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [                
                'dish_id'=>'required',
                'image' => 'required|image',
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
                $picture = Dish::find($request->dish_id);
                $image_path = "images/dishes/".$picture->image;
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $name = $file->getClientOriginalName(); 
                $filename = $request->name . time() . '.' . $extension;
                $file->move('images/dishes/', $filename);

                DB::table('dishes')
                ->where('id', $request->dish_id)
                ->update([
                    'image'=>$filename
                ]);
                
                return response()->json([
                    'status'=>200,
                    'message'=>"Your meal have been updated."
                ]);
            }
        }
    }
}
