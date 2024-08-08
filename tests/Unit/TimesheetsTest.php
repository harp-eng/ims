<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Modules\Timesheet\Models\Timesheet;
use App\Models\User;

class TimesheetsTest extends TestCase
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
        $data = Timesheet::factory()->make()->toArray();

        $response = $this->post('/admin/timesheets', $data);

        $response->assertStatus(302); // Assuming it should return a 201 Created status
        unset($data['created_at'], $data['updated_at'], $data['updated_by'],$data['deleted_by'],$data['created_by']);
        $this->assertDatabaseHas('timesheets', $data); // Check if the timesheet is stored in the database
    }

    /**
     * Test index_list route.
     *
     * @return void
     */
    public function testIndexListRoute()
    {
        $response = $this->get('/admin/timesheets/index_list');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test index_data route.
     *
     * @return void
     */
    public function testIndexDataRoute()
    {
        $response = $this->get('/admin/timesheets/index_data');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test show (view) route.
     *
     * @return void
     */
    public function testShowRoute()
    {
        $timesheet = Timesheet::factory()->create();

        $response = $this->get("/admin/timesheets/{$timesheet->id}");

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test update route.
     *
     * @return void
     */
    public function testUpdateRoute()
    {
        $timesheet = Timesheet::factory()->create();
        $updatedData = [
            'notes' => 'Updated Timesheet Name'
        ];

        $response = $this->put("/admin/timesheets/{$timesheet->id}", $updatedData);

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertDatabaseHas('timesheets', $updatedData); // Check if the timesheet is updated in the database
    }

    /**
     * Test delete (destroy) route.
     *
     * @return void
     */
    public function testDeleteRoute()
    {
        $timesheet = Timesheet::factory()->create();

        $response = $this->delete("/admin/timesheets/{$timesheet->id}");

        $response->assertStatus(302); // Assuming it should return a 204 No Content status
       
        $this->assertDatabaseHas('timesheets', ['id' => $timesheet->id, 'deleted_at' => now()]);
    }

    /**
     * Test trashed route.
     *
     * @return void
     */
    public function testTrashedRoute()
    {
        $response = $this->get('/admin/timesheets/trashed');

        $response->assertStatus(200); // Assuming it should return a 200 OK status
    }

    /**
     * Test restore route.
     *
     * @return void
     */
    public function testRestoreRoute()
    {
        $timesheet = Timesheet::factory()->create(['deleted_at' => now()]);

        $response = $this->patch("/admin/timesheets/trashed/{$timesheet->id}");

        $response->assertStatus(302); // Assuming it should return a 200 OK status
        $this->assertNull($timesheet->fresh()->deleted_at); // Check if the timesheet is restored
    }
}