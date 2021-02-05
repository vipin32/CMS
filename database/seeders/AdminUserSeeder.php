<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where(['email'=>'david@gmail.com'])->first();

        if(!$user) {
            User::create([
                'name' => 'david',
                'email' => 'david@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('123456')
            ]);
        }
    }
}
