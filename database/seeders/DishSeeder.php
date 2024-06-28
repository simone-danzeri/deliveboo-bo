<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allDishes = config('dishes');
        foreach ($allDishes as $eachDish){
            $newDish = new Dish();
            $newDish->fill($eachDish);
            $newDish['dish_slug'] = Str::slug($eachDish['dish_name'], '-');
            $newDish->save();
        }
    }
}
