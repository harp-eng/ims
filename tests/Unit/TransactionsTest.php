<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Transaction\Models\Transaction;
use App\Models\User;

class TransactionsTest extends TestCase
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

    // public function testStoreRoute()
    // {
    //     $data = Transaction::factory()->make()->toArray();

    //     $response = $this->post('/admin/transactions', $data);

    //     $response->assertStatus(302); // Assuming it should return a 201 Created status
    //     unset($data['created_at'], $data['updated_at']);
    //     $this->assertDatabaseHas('transactions', $data); // Check if the transaction is stored in the database
    // }

    /**
     * Test index_list route.
     *
     * @return void
     */
    public function testIndexListRoute()
    {
        $response = $this->get('/admin/transactions/index_list');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test index_data route.
     *
     * @return void
     */
    public function testIndexDataRoute()
    {
        $response = $this->get('/admin/transactions/index_data');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test show (view) route.
     *
     * @return void
     */
    public function testShowRoute()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->get("/admin/transactions/{$transaction->id}");

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdateRoute()
    {
        $transaction = Transaction::factory()->create();
        $updatedData = [
            'description' => 'Updated Transaction Name'
        ];

        $response = $this->put("/admin/transactions/{$transaction->id}", $updatedData);

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertDatabaseHas('transactions', $updatedData); // Check if the transaction is updated in the database
    }

    /**
     * Test delete (destroy) route.
     *
     * @return void
     */
    public function testDeleteRoute()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->delete("/admin/transactions/{$transaction->id}");

        $response->assertStatus(302); // Assuming it should return a 204 No Content status
       
        $this->assertDatabaseHas('transactions', ['id' => $transaction->id, 'deleted_at' => now()]);
    }

    /**
     * Test trashed route.
     *
     * @return void
     */
    public function testTrashedRoute()
    {
        $response = $this->get('/admin/transactions/trashed');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test restore route.
     *
     * @return void
     */
    public function testRestoreRoute()
    {
        $transaction = Transaction::factory()->create(['deleted_at' => now()]);

        $response = $this->patch("/admin/transactions/trashed/{$transaction->id}");

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertNull($transaction->fresh()->deleted_at); // Check if the transaction is restored
    }
}