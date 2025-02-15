<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\patology;

class patologyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_patology()
    {
        $patology = patology::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/patologies', $patology
        );

        $this->assertApiResponse($patology);
    }

    /**
     * @test
     */
    public function test_read_patology()
    {
        $patology = patology::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/patologies/'.$patology->id
        );

        $this->assertApiResponse($patology->toArray());
    }

    /**
     * @test
     */
    public function test_update_patology()
    {
        $patology = patology::factory()->create();
        $editedpatology = patology::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/patologies/'.$patology->id,
            $editedpatology
        );

        $this->assertApiResponse($editedpatology);
    }

    /**
     * @test
     */
    public function test_delete_patology()
    {
        $patology = patology::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/patologies/'.$patology->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/patologies/'.$patology->id
        );

        $this->response->assertStatus(404);
    }
}
