<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\BaseMaterial\Models\BaseMaterial;
use App\Models\User;

class BasematerialsTest extends TestCase
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
        $data = BaseMaterial::factory()->make()->toArray();

        $response = $this->post('/admin/basematerials', $data);

        $response->assertStatus(302); // Assuming it should return a 201 Created status
        unset($data['created_at'], $data['updated_at']);
        $this->assertDatabaseHas('basematerials', $data); // Check if the basematerial is stored in the database
    }

    /**
     * Test index_list route.
     *
     * @return void
     */
    public function testIndexListRoute()
    {
        $response = $this->get('/admin/basematerials/index_list');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test index_data route.
     *
     * @return void
     */
    public function testIndexDataRoute()
    {
        $response = $this->get('/admin/basematerials/index_data');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test show (view) route.
     *
     * @return void
     */
    public function testShowRoute()
    {
        $basematerial = BaseMaterial::factory()->create();

        $response = $this->get("/admin/basematerials/{$basematerial->id}");

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdateRoute()
    {
        $basematerial = BaseMaterial::factory()->create();
        $updatedData = [
            'name' => 'Updated BaseMaterial Name'
        ];

        $response = $this->put("/admin/basematerials/{$basematerial->id}", $updatedData);

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertDatabaseHas('basematerials', $updatedData); // Check if the basematerial is updated in the database
    }

    /**
     * Test delete (destroy) route.
     *
     * @return void
     */
    public function testDeleteRoute()
    {
        $basematerial = BaseMaterial::factory()->create();

        $response = $this->delete("/admin/basematerials/{$basematerial->id}");

        $response->assertStatus(302); // Assuming it should return a 204 No Content status
       
        $this->assertDatabaseHas('basematerials', ['id' => $basematerial->id, 'deleted_at' => now()]);
    }

    /**
     * Test trashed route.
     *
     * @return void
     */
    public function testTrashedRoute()
    {
        $response = $this->get('/admin/basematerials/trashed');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test restore route.
     *
     * @return void
     */
    public function testRestoreRoute()
    {
        $basematerial = BaseMaterial::factory()->create(['deleted_at' => now()]);

        $response = $this->patch("/admin/basematerials/trashed/{$basematerial->id}");

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertNull($basematerial->fresh()->deleted_at); // Check if the basematerial is restored
    }
}
