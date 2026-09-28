<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['Citric Acid Anhydrous', 'Acidulant and Buffering Agent', 'food'],
            ['Citric Acid Monohydrate', 'Acidulant and Buffering Agent', 'food'],
            ['DL Malic Acid', 'Acidulant', 'food'],
            ['Sodium Citrate', 'Buffering Agent', 'food'],
            ['BHA', 'Antioxidant', 'food'],
            ['BHT', 'Antioxidant', 'food'],
            ['Lecithin', 'Emulsifier', 'food'],
            ['Sodium Benzoate', 'Preservative', 'food'],
            ['Potassium Sorbate', 'Preservative', 'food'],
            ['Carrageenan', 'Thickener and Stabilizer', 'food'],
            ['Modified Starch', 'Thickener and Stabilizer', 'food'],
            ['Sucralose', 'Sweetener', 'food'],
            ['Copper Sulphate', 'Mineral', 'feed'],
            ['Dicalcium Phosphate', 'Mineral', 'feed'],
            ['Magnesium Oxide', 'Mineral', 'feed'],
            ['Vitamin C', 'Vitamin', 'feed'],
            ['Vitamin D3', 'Vitamin', 'feed'],
            ['Vitamin E50', 'Vitamin', 'feed'],
            ['Aluminium Sulfate', 'Water Treatment Material', 'industrial'],
            ['ATMP', 'Water Treatment Material', 'industrial'],
            ['Caustic Soda 48%', 'Industrial Process Material', 'industrial'],
            ['Caustic Soda Flake 98%', 'Industrial Process Material', 'industrial'],
            ['Hydrochloric Acid', 'Industrial Process Material', 'industrial'],
            ['Hydrogen Peroxide 50%', 'Industrial Process Material', 'industrial'],
            ['Sodium Hypochlorite', 'Sanitation and Treatment Material', 'industrial'],
            ['Sodium Sulfite', 'Industrial Process Material', 'industrial'],
        ];

        foreach ($products as $sortOrder => [$name, $function, $category]) {
            Product::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name_id' => $name,
                    'name_en' => $name,
                    'category' => $category,
                    'summary_id' => $function,
                    'summary_en' => $function,
                    'is_published' => true,
                    'sort_order' => $sortOrder,
                ],
            );
        }
    }
}
