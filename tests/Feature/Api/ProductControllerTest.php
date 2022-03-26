<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{

    public function testProductIndex()
    {
        $response = $this->get(route('product.index'), [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(200);
    }

    public function testProductStoreInvalidData()
    {
        $data = [
            'name' => 'Book with no price'
        ];
        $response = $this->post(route('product.store'), $data, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);
        $response->assertStatus(422);
    }

    public function testProductStoreCorrectData()
    {
        $data = [
            'name' => 'Test book',
            'price' => 49.99
        ];
        $response = $this->post(route('product.store'), $data, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);
        $response->assertStatus(200);
    }

    public function testProductView()
    {
        $product = Product::factory()->create();
        $response = $this->get(route('product.show', ['product' => $product->id ]), [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(200);
    }

    public function testProductViewIncorrectId()
    {
        $response = $this->get(route('product.show', ['product' => 0 ]), [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(404);
    }

    public function testProductUpdateIncorrectId()
    {
        $data = [
            'name' => 'Test book',
            'price' => 49.99
        ];

        $response = $this->put(route('product.update', ['product' => 0 ]), $data, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(404);
    }

    public function testProductUpdateInvalidData()
    {
        $data = [
            'name' => 'Test book'
        ];
        $product = Product::factory()->create();
        $response = $this->put(route('product.update', ['product' => $product->id ]), $data, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(422);
    }

    public function testProductUpdateCorrectData()
    {
        $data = [
            'name' => 'Updated book',
            'price' => 300.00
        ];
        $product = Product::factory()->create();
        $response = $this->put(route('product.update', ['product' => $product->id ]), $data, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
    }

    public function testProductDeleteIncorrectId()
    {
        $response = $this->delete(route('product.destroy', ['product' => 0 ]), [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(404);
    }

    public function testProductDeleteCorrectId()
    {
        $product = Product::factory()->create();
        $response = $this->delete(route('product.destroy', ['product' => $product->id ]), [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(200);
    }


}
