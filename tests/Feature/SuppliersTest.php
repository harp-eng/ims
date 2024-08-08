<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Supplier\Models\Supplier;
use App\Models\User;

class SuppliersTest extends TestCase
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
        $data = Supplier::factory()->make()->toArray();

        $response = $this->post('/admin/suppliers', $data);

        $response->assertStatus(302); // Assuming it should return a 201 Created status
        unset($data['created_at'], $data['updated_at']);
        $this->assertDatabaseHas('suppliers', $data); // Check if the supplier is stored in the database
    }

    /**
     * Test index_list route.
     *
     * @return void
     */
    public function testIndexListRoute()
    {
        $response = $this->get('/admin/suppliers/index_list');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test index_data route.
     *
     * @return void
     */
    public function testIndexDataRoute()
    {
        $response = $this->get('/admin/suppliers/index_data');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test show (view) route.
     *
     * @return void
     */
    public function testShowRoute()
    {
        $supplier = Supplier::factory()->create();

        $response = $this->get("/admin/suppliers/{$supplier->id}");

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdateRoute()
    {
        $supplier = Supplier::factory()->create();
        $updatedData = [
            'ContactName' => 'Updated Supplier Name'
        ];

        $response = $this->put("/admin/suppliers/{$supplier->id}", $updatedData);

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertDatabaseHas('suppliers', $updatedData); // Check if the supplier is updated in the database
    }

    /**
     * Test delete (destroy) route.
     *
     * @return void
     */
    public function testDeleteRoute()
    {
        $supplier = Supplier::factory()->create();

        $response = $this->delete("/admin/suppliers/{$supplier->id}");

        $response->assertStatus(302); // Assuming it should return a 204 No Content status
       
        $this->assertDatabaseHas('suppliers', ['id' => $supplier->id, 'deleted_at' => now()]);
    }

    /**
     * Test trashed route.
     *
     * @return void
     */
    public function testTrashedRoute()
    {
        $response = $this->get('/admin/suppliers/trashed');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test restore route.
     *
     * @return void
     */
    public function testRestoreRoute()
    {
        $supplier = Supplier::factory()->create(['deleted_at' => now()]);

        $response = $this->patch("/admin/suppliers/trashed/{$supplier->id}");

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertNull($supplier->fresh()->deleted_at); // Check if the supplier is restored
    }
}