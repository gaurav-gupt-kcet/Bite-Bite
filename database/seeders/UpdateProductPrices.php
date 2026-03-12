<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateProductPrices extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products and update prices with discount
        $products = DB::table('products')->get();
        
        foreach ($products as $product) {
            // Set original price 3x of current price (for 66% discount look)
            $originalPrice = $product->price * 3;
            // Set offer price as current price
            $offerPrice = $product->price;
            
            DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'original_price' => $originalPrice,
                    'offer_price' => $offerPrice
                ]);
        }
        
        echo "Updated prices for " . count($products) . " products!";
    }
}
