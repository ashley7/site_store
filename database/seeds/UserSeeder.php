<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->name = "Site Owner";

        $user->email = "tegiikejack@gmail.com";

        $user->password = Hash::make('admin123@');

        $user->user_type = "admin";

        $user->remember_token = \Str::random(32);

        try {
            $user->save();
        } catch (\Throwable $th) {}


    }
}
