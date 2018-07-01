<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	UsersTableSeeder::class,
            AdminsTableSeeder::class,
            CategoriesTableSeeder::class,
            ColorsTableSeeder::class,
            SizesTableSeeder::class,
            ProductsTableSeeder::class,
            CommentsTableSeeder::class,
        ]);
    }
}
