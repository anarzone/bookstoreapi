<?php

use Illuminate\Database\Seeder;
use App\User;
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
        User::truncate();
        User::create([
            'name'      => 'Elon Musk',
            'email'     => 'musk@gmail.com',
            'password'  => Hash::make('123456'),
        ]);
    }
}
