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

class UsersController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $users = DB::table('users')
                    ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->leftJoin('profiles','users.id','=','profiles.user_id')
                    ->select('users.*','profiles.mobile_number','profiles.photo','profiles.street','profiles.barangay','profiles.city','profiles.province')
                    ->where('model_id',2)
                    ->orderBy('last_name', 'ASC')
                    ->get();

            return view('admin.users', compact('users'));
        }
    }

    public function destroy(Request $request,String $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            DB::table('users')
            ->where('id', $request->user_id)
            ->delete();

            return redirect('/users');
        }
    }
}
