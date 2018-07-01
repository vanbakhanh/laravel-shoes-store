<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = factory(App\Models\User::class, 3)->create();

    	$userDefault = App\Models\User::create([
    		'name' => 'User',
    		'email' => 'user@laravel.com',
    		'password' => bcrypt('secret'),
    		'address' => '2xx Ho Tung Mau, Lien Chieu, Da Nang',
    		'phone' => '09357548xx',
    		'birthday' => '1997/10/06',
    		'gender' => 'male',
    		'status' => '1',
    		'token' => str_random(60),
    	]);
    }
}
