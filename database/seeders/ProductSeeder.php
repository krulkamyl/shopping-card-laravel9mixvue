<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Repository\Eloquent\ProductRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRepository = new ProductRepository(new Product());
        $data = [
            [
                'name' => 'The Godfather',
                'price' => 59.99
            ],
            [
                'name' => 'Steve Jobs',
                'price' => 49.95
            ],
            [
                'name' => 'The Return of Sherlock Holmes',
                'price' => 39.99
            ],
            [
                'name' => 'The Little Prince',
                'price' => 29.99
            ],
            [
                'name' => 'I Hate Myselfie!',
                'price' => 19.99
            ],
            [
                'name' => 'The Trial',
                'price' => 9.99
            ]
        ];
        foreach ($data as $item) {
            $productRepository->create($item);
        }
    }
}
