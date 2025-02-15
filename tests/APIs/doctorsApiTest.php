<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\doctors;

class doctorsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_doctors()
    {
        $doctors = doctors::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/doctors', $doctors
        );

        $this->assertApiResponse($doctors);
    }

    /**
     * @test
     */
    public function test_read_doctors()
    {
        $doctors = doctors::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/doctors/'.$doctors->id
        );

        $this->assertApiResponse($doctors->toArray());
    }

    /**
     * @test
     */
    public function test_update_doctors()
    {
        $doctors = doctors::factory()->create();
        $editeddoctors = doctors::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/doctors/'.$doctors->id,
            $editeddoctors
        );

        $this->assertApiResponse($editeddoctors);
    }

    /**
     * @test
     */
    public function test_delete_doctors()
    {
        $doctors = doctors::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/doctors/'.$doctors->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/doctors/'.$doctors->id
        );

        $this->response->assertStatus(404);
    }
}
