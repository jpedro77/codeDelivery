<?php

use CodeDelivery\Models\Product;
use CodeDelivery\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Category::class, 10)->create()->each(function ($e){
           for($i=0; $i <= 5; $i++){
               $e->products()->save(factory(Product::class)->make());
           }
       });
    }
}
