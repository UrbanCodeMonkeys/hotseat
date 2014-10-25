<?php

use Illuminate\Database\Seeder;
use App\Desk;

class DeskTableSeeder extends Seeder {

    public function run()
    {
        DB::table('desks')->delete();

        $desks = [
        	array(
        		'location' => 'London Office - Desk 1',
        		'description' => 'Next to the window',
        		'number' => '1',
        		'extension' => '5698',
        	),
        	array(
        		'location' => 'London Office - Desk 2',
        		'description' => 'Near the door',
        		'number' => '2',
        		'extension' => '4356',
        	),
        	array(
        		'location' => 'Headquarters - Desk 1',
        		'description' => 'In the basement',
        		'number' => '1',
        		'extension' => '2893',
        	),
        	array(
        		'location' => 'Headquarters - Desk 2',
        		'description' => '1st Floor near the stairs',
        		'number' => '2',
        		'extension' => '2894',
        	),
        	array(
        		'location' => 'Headquarters - Desk 3',
        		'description' => '1st Floor near the window',
        		'number' => '3',
        		'extension' => '2895',
        	)
        ];
        foreach($desks as $desk) Desk::create($desk);
    }

}
