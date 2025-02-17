<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make('12345678'),
                'role'=>'admin',
                'status'=>'active'
            ],
            //user
            [
                'name'=>'user_1',
                'email'=>'user_1@user.com',
                'password'=>Hash::make('12345678'),
                'role'=>'user',
                'status'=>'active'
            ],
            //agent
            [
                'name'=>'agent_1',
                'email'=>'agent_1@agent.com',
                'password'=>Hash::make('12345678'),
                'role'=>'agent',
                'status'=>'active'
            ],
        ]);

    }
}
