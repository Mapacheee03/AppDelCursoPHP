<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 5 categorías
        $categories = Category::factory(5)->create();

        // Crear 20 productos asignados a categorías aleatorias
        Product::factory(20)->create()->each(function ($product) use ($categories) {
            $product->update([
                'category_id' => $categories->random()->id
            ]);
        });

        $this->command->info('✅ Base de datos sembrada con éxito!');
        $this->command->info('📊 Categorías creadas: ' . $categories->count());
        $this->command->info('📦 Productos creados: 20');
    }
}