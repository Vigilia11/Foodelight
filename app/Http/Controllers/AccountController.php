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
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            return view('account');
        }
    }

    public function fetchAccount()
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $account = User::find(Auth::id())->get();

            return response()->json([
                'account'=>$account,
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $validator = Validator::make($request->all(), [
                'current_password'=>'required|current_password',
                'password'=>'required|confirmed',
                'password_confirmation'=>'required'
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else{
                DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'password'=>Hash::make($request->password)
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Your password have been updated."
                ]);
            }
        }
    }

    public function updateName(Request $request)
    {
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
        {
            $validator = Validator::make($request->all(), [
                'first_name'=>'required|string',
                'last_name'=>'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'status'=>404,
                    'errors'=>$validator->errors()->toArray(),
                ]);
            }
            else{
                DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Your name have been updated."
                ]);
            }
        }
    }
}
