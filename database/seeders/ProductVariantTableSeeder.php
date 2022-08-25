<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductVariant;

class ProductVariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $one=['green',"m",'N/A'];
        $two=['blue',"sm",'l','Neck'];
        $three=['red',"xl",'l','round'];
        $four=['N/A','m',"xxl",'N/A'];
        $five=['black',"sm",'m','neck'];

        ProductVariant::create([
            'variant'=>$one,
            'variant_id'=>1,
            'product_id'=>1
        ]);
        ProductVariant::create([
            'variant'=>$two,
            'variant_id'=>2,
            'product_id'=>2
        ]);
        ProductVariant::create([
            'variant'=>$three,
            'variant_id'=>1,
            'product_id'=>3
        ]);
        ProductVariant::create([
            'variant'=>$four,
            'variant_id'=>3,
            'product_id'=>4
        ]);
        ProductVariant::create([
            'variant'=>$five,
            'variant_id'=>1,
            'product_id'=>5
        ]);
        ProductVariant::create([
            'variant'=>$one,
            'variant_id'=>1,
            'product_id'=>6
        ]);
        ProductVariant::create([
            'variant'=>$two,
            'variant_id'=>2,
            'product_id'=>7
        ]);
        ProductVariant::create([
            'variant'=>$three,
            'variant_id'=>1,
            'product_id'=>8
        ]);
        ProductVariant::create([
            'variant'=>$four,
            'variant_id'=>3,
            'product_id'=>9
        ]);
        ProductVariant::create([
            'variant'=>$five,
            'variant_id'=>1,
            'product_id'=>10
        ]);
    }
}
