<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\procedures_homologator;

class procedures_homologatorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_procedures_homologator()
    {
        $proceduresHomologator = procedures_homologator::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/procedures_homologators', $proceduresHomologator
        );

        $this->assertApiResponse($proceduresHomologator);
    }

    /**
     * @test
     */
    public function test_read_procedures_homologator()
    {
        $proceduresHomologator = procedures_homologator::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/procedures_homologators/'.$proceduresHomologator->id
        );

        $this->assertApiResponse($proceduresHomologator->toArray());
    }

    /**
     * @test
     */
    public function test_update_procedures_homologator()
    {
        $proceduresHomologator = procedures_homologator::factory()->create();
        $editedprocedures_homologator = procedures_homologator::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/procedures_homologators/'.$proceduresHomologator->id,
            $editedprocedures_homologator
        );

        $this->assertApiResponse($editedprocedures_homologator);
    }

    /**
     * @test
     */
    public function test_delete_procedures_homologator()
    {
        $proceduresHomologator = procedures_homologator::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/procedures_homologators/'.$proceduresHomologator->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/procedures_homologators/'.$proceduresHomologator->id
        );

        $this->response->assertStatus(404);
    }
}
