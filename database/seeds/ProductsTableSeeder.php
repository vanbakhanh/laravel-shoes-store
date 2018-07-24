<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = factory(App\Models\Product::class, 100)
        ->create()
        ->each(function ($u) {
            $u->color()->attach(App\Models\Color::pluck('id')->take(rand(1, 10)));
            $u->size()->attach(App\Models\Size::pluck('id')->take(rand(1, 10)));
        });
    }
}
