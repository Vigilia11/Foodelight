<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Profile;

class UserProfileController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin')){
            
            $profile = User::with('profile')->find(Auth::id())->profile;
            
            if(is_null($profile))
            {
                return view('createProfile');
            }
            else{
                return view('profile');
            }
            //return view('createProfile');
            
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $request->validate([
                'photo'=>['required','image','mimes:jpeg,png,jpg,gif,svg'],
                'mobile_number'=>['required','min:11','max:11'],
                'street'=>['required','string'],
                'barangay'=>['required','string'],
                'city'=>['required','string'],
                'province'=>['required','string'],
            ]);

            $photo;
            if(is_null($request->photo))
            {
                $photo = "user.png";
            }
            else{
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                //$name = $request->file('image')->getClientOriginalName(); 
                $name = $file->getClientOriginalName(); 
                //$filename = $name . time() . '.' . $extension;
                $filename = $request->name . time() . '.' . $extension;
                $file->move('images/profile/', $filename);
                $photo = $filename;
            }

            Profile::create([
                'user_id'=>Auth::id(),
                'mobile_number'=>$request->mobile_number,
                'photo'=>$photo,
                'street'=>$request->street,
                'barangay'=>$request->barangay,
                'city'=>$request->city,
                'province'=>$request->province,
                'country'=>"Philippines"
            ]);

            return redirect('/profile');
        }
    }

    public function fetchProfile()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $profile = DB::table('profiles')
                    ->where('user_id', Auth::id())
                    ->get();
            
            return response()->json([
                'profile'=>$profile,
            ]);
        }
    }

    public function updateProfilePhoto(Request $request)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $validator = Validator::make($request->all(), [
                'photo'=>['required','image','mimes:jpeg,png,jpg,gif,svg'],
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else{
                $picture = User::with('profile')->find(Auth::id())->profile;
                $image_path = "images/profile/".$picture->photo;
                
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                //$name = $request->file('image')->getClientOriginalName(); 
                $name = $file->getClientOriginalName(); 
                //$filename = $name . time() . '.' . $extension;
                $filename = $request->name . time() . '.' . $extension;
                $file->move('images/profile/', $filename);

                DB::table('profiles')
                ->where('user_id', Auth::id())
                ->update([
                    'photo'=>$filename,
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>'Your photo have been updated.',
                ]);
            }
        }
    }

    public function updateProfileInfo(Request $request)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $validator = Validator::make($request->all(), [
                'mobile_number'=>'required|min:11|max:11',
                'street'=>'required|string',
                'barangay'=>'required|string',
                'city'=>'required|string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else{

                DB::table('profiles')
                ->where('user_id', Auth::id())
                ->update([
                    'mobile_number'=>$request->mobile_number,
                    'street'=>$request->street,
                    'barangay'=>$request->barangay,
                    'city'=>$request->city,
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>'Your info have been updated.',
                ]);
            }
        }
    }

}
