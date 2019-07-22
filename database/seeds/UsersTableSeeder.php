<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'yevabe',
            'email' => 'yevabe@gmail.com',
            'password' => bcrypt('yevabe060175'),
            'admin' => true
        ]);
    }
}
