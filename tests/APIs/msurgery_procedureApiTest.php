<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\msurgery_procedure;

class msurgery_procedureApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_msurgery_procedure()
    {
        $msurgeryProcedure = msurgery_procedure::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/msurgery_procedures', $msurgeryProcedure
        );

        $this->assertApiResponse($msurgeryProcedure);
    }

    /**
     * @test
     */
    public function test_read_msurgery_procedure()
    {
        $msurgeryProcedure = msurgery_procedure::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/msurgery_procedures/'.$msurgeryProcedure->id
        );

        $this->assertApiResponse($msurgeryProcedure->toArray());
    }

    /**
     * @test
     */
    public function test_update_msurgery_procedure()
    {
        $msurgeryProcedure = msurgery_procedure::factory()->create();
        $editedmsurgery_procedure = msurgery_procedure::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/msurgery_procedures/'.$msurgeryProcedure->id,
            $editedmsurgery_procedure
        );

        $this->assertApiResponse($editedmsurgery_procedure);
    }

    /**
     * @test
     */
    public function test_delete_msurgery_procedure()
    {
        $msurgeryProcedure = msurgery_procedure::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/msurgery_procedures/'.$msurgeryProcedure->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/msurgery_procedures/'.$msurgeryProcedure->id
        );

        $this->response->assertStatus(404);
    }
}
