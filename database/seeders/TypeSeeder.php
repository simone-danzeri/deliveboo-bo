<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesArray = config('types');
        foreach($typesArray as $eachType) {
            $newType = new Type();
            $newType->type_name = $eachType;
            $newType->save();
        }
    }
}
