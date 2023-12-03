<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        //Let's assume that we have a user with ID 4
        $user = User::find(4);
        //Insert a phone for the user
        Phone::create([
            'user_id' => $user->id,
            'number' => '0593687636'
        ]);


        $user = User::find(10);
        //Insert a phone for the user
        Phone::create([
            'user_id' => $user->id,
            'number' => '0595112394'
        ]);

        $user = User::find(11);
        //Insert a phone for the user
        Phone::create([
            'user_id' => $user->id,
            'number' => '0597312462'
        ]);
    }
}
