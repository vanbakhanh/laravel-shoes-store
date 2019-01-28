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

        App\Models\User::find(1)->update([
            'name' => 'User',
            'email' => 'user@laravel.com',
            'password' => 'secret',
            'address' => '2xx Ho Tung Mau, Lien Chieu, Da Nang',
            'phone' => '09357548xx',
            'birthday' => '1997/10/06',
            'gender' => 'male',
            'status' => '1',
        ]);
    }
}
