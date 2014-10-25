<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        $users = [
            array(
                'email' => 'alex@urbancodemonkeys.co.uk',
                'firstname' => 'Alex',
                'lastname' => 'Miller',
                'password' => Hash::make('password'),
            ),
            array(
                'email' => 'andrew@urbancodemonkeys.co.uk',
                'firstname' => 'Andrew',
                'lastname' => 'Pairman',
                'password' => Hash::make('password'),
            ),
            array(
                'email' => 'gareth@urbancodemonkeys.co.uk',
                'firstname' => 'Gareth',
                'lastname' => 'Drew',
                'password' => Hash::make('password'),
            )
        ];
        foreach($users as $user) User::create($user);
    }

}
