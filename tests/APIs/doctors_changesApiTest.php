<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\doctors_changes;

class doctors_changesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_doctors_changes()
    {
        $doctorsChanges = doctors_changes::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/doctors_changes', $doctorsChanges
        );

        $this->assertApiResponse($doctorsChanges);
    }

    /**
     * @test
     */
    public function test_read_doctors_changes()
    {
        $doctorsChanges = doctors_changes::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/doctors_changes/'.$doctorsChanges->id
        );

        $this->assertApiResponse($doctorsChanges->toArray());
    }

    /**
     * @test
     */
    public function test_update_doctors_changes()
    {
        $doctorsChanges = doctors_changes::factory()->create();
        $editeddoctors_changes = doctors_changes::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/doctors_changes/'.$doctorsChanges->id,
            $editeddoctors_changes
        );

        $this->assertApiResponse($editeddoctors_changes);
    }

    /**
     * @test
     */
    public function test_delete_doctors_changes()
    {
        $doctorsChanges = doctors_changes::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/doctors_changes/'.$doctorsChanges->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/doctors_changes/'.$doctorsChanges->id
        );

        $this->response->assertStatus(404);
    }
}
