<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Ingredient\Models\Ingredient;
use App\Models\User;

class IngredientsTest extends TestCase
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
        $data = Ingredient::factory()->make()->toArray();

        $response = $this->post('/admin/ingredients', $data);

        $response->assertStatus(302); // Assuming it should return a 201 Created status
        unset($data['created_at'], $data['updated_at']);
        $this->assertDatabaseHas('ingredients', $data); // Check if the ingredient is stored in the database
    }

    /**
     * Test index_list route.
     *
     * @return void
     */
    public function testIndexListRoute()
    {
        $response = $this->get('/admin/ingredients/index_list');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test index_data route.
     *
     * @return void
     */
    public function testIndexDataRoute()
    {
        $response = $this->get('/admin/ingredients/index_data');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test show (view) route.
     *
     * @return void
     */
    public function testShowRoute()
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->get("/admin/ingredients/{$ingredient->id}");

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdateRoute()
    {
        $ingredient = Ingredient::factory()->create();
        $updatedData = [
            'name' => 'Updated Ingredient Name'
        ];

        $response = $this->put("/admin/ingredients/{$ingredient->id}", $updatedData);

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertDatabaseHas('ingredients', $updatedData); // Check if the ingredient is updated in the database
    }

    /**
     * Test delete (destroy) route.
     *
     * @return void
     */
    public function testDeleteRoute()
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->delete("/admin/ingredients/{$ingredient->id}");

        $response->assertStatus(302); // Assuming it should return a 204 No Content status
       
        $this->assertDatabaseHas('ingredients', ['id' => $ingredient->id, 'deleted_at' => now()]);
    }

    /**
     * Test trashed route.
     *
     * @return void
     */
    public function testTrashedRoute()
    {
        $response = $this->get('/admin/ingredients/trashed');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test restore route.
     *
     * @return void
     */
    public function testRestoreRoute()
    {
        $ingredient = Ingredient::factory()->create(['deleted_at' => now()]);

        $response = $this->patch("/admin/ingredients/trashed/{$ingredient->id}");

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertNull($ingredient->fresh()->deleted_at); // Check if the ingredient is restored
    }
}
