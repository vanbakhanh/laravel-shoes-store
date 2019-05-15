<?php

use App\Models\User;
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
        factory(User::class, 3)->create()->each(function ($u) {
            $u->profile()->save(factory(App\Models\Profile::class)->make());
        });

        User::find(1)->update([
            'email' => 'user@shoesstore.com',
            'password' => 'secret',
            'status' => User::ACTIVE,
        ]);
    }
}
