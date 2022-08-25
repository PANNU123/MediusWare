<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Variant;


class VariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Variant::create([
            'title'=>'color',
            'description'=>'Choose Color'

        ]);
        Variant::create([
            'title'=>'size',
            'description'=>'Choose Size'
        ]);
        Variant::create([
            'title'=>'style',
            'description'=>'Choose style'
        ]);
    }
}
