<?php

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVariant::create([
            'variant'=>'sm',
            'variant_id'=>1,
            'product_id'=>1
        ]);
    }
}
