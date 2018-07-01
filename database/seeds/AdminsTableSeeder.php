<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admins = factory(App\Models\Admin::class, 3)->create();

    	$adminDefault = App\Models\Admin::create([
    		'name' => 'Admin',
    		'email' => 'admin@laravel.com',
    		'password' => bcrypt('secret'),
    		'remember_token' => str_random(10),
    	]);
    }
}
