<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_operation_cost;

class log_operation_costApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_operation_cost()
    {
        $logOperationCost = log_operation_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_operation_costs', $logOperationCost
        );

        $this->assertApiResponse($logOperationCost);
    }

    /**
     * @test
     */
    public function test_read_log_operation_cost()
    {
        $logOperationCost = log_operation_cost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_operation_costs/'.$logOperationCost->id
        );

        $this->assertApiResponse($logOperationCost->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_operation_cost()
    {
        $logOperationCost = log_operation_cost::factory()->create();
        $editedlog_operation_cost = log_operation_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_operation_costs/'.$logOperationCost->id,
            $editedlog_operation_cost
        );

        $this->assertApiResponse($editedlog_operation_cost);
    }

    /**
     * @test
     */
    public function test_delete_log_operation_cost()
    {
        $logOperationCost = log_operation_cost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_operation_costs/'.$logOperationCost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_operation_costs/'.$logOperationCost->id
        );

        $this->response->assertStatus(404);
    }
}
