<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Location\Models\Location;
use App\Models\User;

class LocationsTest extends TestCase
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
        $data = Location::factory()->make()->toArray();

        $response = $this->post('/admin/locations', $data);

        $response->assertStatus(302); // Assuming it should return a 201 Created status
        unset($data['created_at'], $data['updated_at']);
        $this->assertDatabaseHas('locations', $data); // Check if the location is stored in the database
    }

    /**
     * Test index_list route.
     *
     * @return void
     */
    public function testIndexListRoute()
    {
        $response = $this->get('/admin/locations/index_list');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test index_data route.
     *
     * @return void
     */
    public function testIndexDataRoute()
    {
        $response = $this->get('/admin/locations/index_data');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test show (view) route.
     *
     * @return void
     */
    public function testShowRoute()
    {
        $location = Location::factory()->create();

        $response = $this->get("/admin/locations/{$location->id}");

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdateRoute()
    {
        $location = Location::factory()->create();
        $updatedData = [
            'name' => 'Updated Location Name'
        ];

        $response = $this->put("/admin/locations/{$location->id}", $updatedData);

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertDatabaseHas('locations', $updatedData); // Check if the location is updated in the database
    }

    /**
     * Test delete (destroy) route.
     *
     * @return void
     */
    public function testDeleteRoute()
    {
        $location = Location::factory()->create();

        $response = $this->delete("/admin/locations/{$location->id}");

        $response->assertStatus(302); // Assuming it should return a 204 No Content status
       
        $this->assertDatabaseHas('locations', ['id' => $location->id, 'deleted_at' => now()]);
    }

    /**
     * Test trashed route.
     *
     * @return void
     */
    public function testTrashedRoute()
    {
        $response = $this->get('/admin/locations/trashed');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test restore route.
     *
     * @return void
     */
    public function testRestoreRoute()
    {
        $location = Location::factory()->create(['deleted_at' => now()]);

        $response = $this->patch("/admin/locations/trashed/{$location->id}");

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertNull($location->fresh()->deleted_at); // Check if the location is restored
    }
}
