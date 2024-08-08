<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Order\Models\Order;
use App\Models\User;

class OrdersTest extends TestCase
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
        $data = Order::factory()->make()->toArray();

        $response = $this->post('/admin/orders', $data);

        $response->assertStatus(302); // Assuming it should return a 201 Created status
        unset($data['created_at'], $data['updated_at'], $data['updated_by'],$data['TotalAmount'],$data['created_by']);
        $this->assertDatabaseHas('orders', $data); // Check if the order is stored in the database
    }

    /**
     * Test index_list route.
     *
     * @return void
     */
    public function testIndexListRoute()
    {
        $response = $this->get('/admin/orders/index_list');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test index_data route.
     *
     * @return void
     */
    public function testIndexDataRoute()
    {
        $response = $this->get('/admin/orders/index_data');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test show (view) route.
     *
     * @return void
     */
    public function testShowRoute()
    {
        $order = Order::factory()->create();

        $response = $this->get("/admin/orders/{$order->id}");

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdateRoute()
    {
        $order = Order::factory()->create();
        $updatedData = [
            'description' => 'Updated Order Name'
        ];

        $response = $this->put("/admin/orders/{$order->id}", $updatedData);

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertDatabaseHas('orders', $updatedData); // Check if the order is updated in the database
    }

    /**
     * Test delete (destroy) route.
     *
     * @return void
     */
    public function testDeleteRoute()
    {
        $order = Order::factory()->create();

        $response = $this->delete("/admin/orders/{$order->id}");

        $response->assertStatus(302); // Assuming it should return a 204 No Content status
       
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'deleted_at' => now()]);
    }

    /**
     * Test trashed route.
     *
     * @return void
     */
    public function testTrashedRoute()
    {
        $response = $this->get('/admin/orders/trashed');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test restore route.
     *
     * @return void
     */
    public function testRestoreRoute()
    {
        $order = Order::factory()->create(['deleted_at' => now()]);

        $response = $this->patch("/admin/orders/trashed/{$order->id}");

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertNull($order->fresh()->deleted_at); // Check if the order is restored
    }
}

