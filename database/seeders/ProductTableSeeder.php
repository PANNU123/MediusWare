<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title'=>'Product one',
            'sku'=>'product_one',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        Product::create([
            'title'=>'Product two',
            'sku'=>'product_two',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        Product::create([
            'title'=>'Product three',
            'sku'=>'product_three',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        Product::create([
            'title'=>'Product four',
            'sku'=>'product_four',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        Product::create([
            'title'=>'Product five',
            'sku'=>'product_five',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);

        Product::create([
            'title'=>'Product six',
            'sku'=>'product_six',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        Product::create([
            'title'=>'Product seven',
            'sku'=>'product_seven',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        Product::create([
            'title'=>'Product eight',
            'sku'=>'product_eight',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        Product::create([
            'title'=>'Product nine',
            'sku'=>'product_nine',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
        Product::create([
            'title'=>'Product ten',
            'sku'=>'product_ten',
            'price'=>rand(15,1000),
            'qty'=>rand(50,100),
            'description'=>'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum',
        ]);
    }
}
