<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

    	foreach(range(1,20) as $index){

    		DB::table('users')->insert([
    			'name'=> $faker->name,
    			'email' => $faker->email,
    			'password' => bcrypt('123123'),
    		]);
    	}



    	$interest_array=['Reading','Movies','Fishing','Gardening','Walking','Exercise','Hunting' ,'Sports', 'Shopping','Traveling','Golf','Relaxing','Music','Crafts','Bicycling'];

foreach ($interest_array as $interest ) {

        DB::table('interests')->insert([
        	
        	  'interest' => $interest
        
        ]);
    }


    }
}
