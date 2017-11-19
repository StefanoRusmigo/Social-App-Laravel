<?php

use Illuminate\Database\Seeder;

class InterestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


$interest_array=['Reading','Movies','Fishing','Gardening','Walking','Exercise','Hunting' ,'Sports',
'Shopping','Traveling','Golf','Relaxing','Music','Crafts','Bicycling'];

foreach ($interest_array as $interest ) {

        DB::table('interests')->insert([
        	
        	  'interest' => $interest
        
        ]);
    }

    }
}
