<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\procedures;

class proceduresApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_procedures()
    {
        $procedures = procedures::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/procedures', $procedures
        );

        $this->assertApiResponse($procedures);
    }

    /**
     * @test
     */
    public function test_read_procedures()
    {
        $procedures = procedures::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/procedures/'.$procedures->id
        );

        $this->assertApiResponse($procedures->toArray());
    }

    /**
     * @test
     */
    public function test_update_procedures()
    {
        $procedures = procedures::factory()->create();
        $editedprocedures = procedures::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/procedures/'.$procedures->id,
            $editedprocedures
        );

        $this->assertApiResponse($editedprocedures);
    }

    /**
     * @test
     */
    public function test_delete_procedures()
    {
        $procedures = procedures::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/procedures/'.$procedures->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/procedures/'.$procedures->id
        );

        $this->response->assertStatus(404);
    }
}
