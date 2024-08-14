<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Product\Models\Product;
use App\Models\User;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->seed();
        // Artisan::call('db:seed');

        // Get Super Admin
        $user = User::whereId(1)->first();

        $this->actingAs($user);
    }

    public function testStoreRoute()
    {
        $data = Product::factory()->make()->toArray();

        $response = $this->post('/admin/products', $data);

        $response->assertStatus(302); // Assuming it should return a 201 Created status
        unset($data['created_at'], $data['updated_at']);
        $this->assertDatabaseHas('products', $data); // Check if the product is stored in the database
    }

    /**
     * Test index_list route.
     *
     * @return void
     */
    public function testIndexListRoute()
    {
        $response = $this->get('/admin/products/index_list');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test index_data route.
     *
     * @return void
     */
    public function testIndexDataRoute()
    {
        $response = $this->get('/admin/products/index_data');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test show (view) route.
     *
     * @return void
     */
    public function testShowRoute()
    {
        $product = Product::factory()->create();

        $response = $this->get("/admin/products/{$product->id}");

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdateRoute()
    {
        $product = Product::factory()->create();
        $updatedData = [
            'name' => 'Updated Product Name'
        ];

        $response = $this->put("/admin/products/{$product->id}", $updatedData);

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertDatabaseHas('products', $updatedData); // Check if the product is updated in the database
    }

    /**
     * Test delete (destroy) route.
     *
     * @return void
     */
    public function testDeleteRoute()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/admin/products/{$product->id}");

        $response->assertStatus(302); // Assuming it should return a 204 No Content status
       
        $this->assertDatabaseHas('products', ['id' => $product->id, 'deleted_at' => now()]);
    }

    /**
     * Test trashed route.
     *
     * @return void
     */
    public function testTrashedRoute()
    {
        $response = $this->get('/admin/products/trashed');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test restore route.
     *
     * @return void
     */
    public function testRestoreRoute()
    {
        $product = Product::factory()->create(['deleted_at' => now()]);

        $response = $this->patch("/admin/products/trashed/{$product->id}");

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertNull($product->fresh()->deleted_at); // Check if the product is restored
    }
}

