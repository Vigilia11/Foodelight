<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name'=>"Paul John",
            'last_name'=>"Vigilia",
            'account_status'=>"Active",
            'email'=>'pjadmin@email.com',
            'password'=>hash::make('adminpassword')
        ]);

        $user->assignRole('admin');
    }
}
