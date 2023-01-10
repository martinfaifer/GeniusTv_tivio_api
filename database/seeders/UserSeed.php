<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            User::create([
                'name' => 'Martin',
                'email' => 'faifer@grapesc.cz',
                'password' => bcrypt('1122334455'),
                'isAdmin' => true,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
