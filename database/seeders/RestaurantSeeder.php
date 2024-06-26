<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantArray = config('restaurants');
        foreach($restaurantArray as $eachRestaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->restaurant_name = $eachRestaurant['restaurant_name'];
            $newRestaurant->slug = $eachRestaurant['slug'];
            $newRestaurant->user_id = $eachRestaurant['user_id'];
            $newRestaurant->address = $eachRestaurant['address'];
            $newRestaurant->phone = $eachRestaurant['phone'];
            $newRestaurant->img = $eachRestaurant['img'];
            $newRestaurant->email = $eachRestaurant['email'];
            $newRestaurant->vat_number = $eachRestaurant['vat_number'];
            $newRestaurant->save();
        }
    }
}
