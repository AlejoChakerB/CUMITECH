<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_unit_cost;

class log_unit_costApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_unit_cost()
    {
        $logUnitCost = log_unit_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_unit_costs', $logUnitCost
        );

        $this->assertApiResponse($logUnitCost);
    }

    /**
     * @test
     */
    public function test_read_log_unit_cost()
    {
        $logUnitCost = log_unit_cost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_unit_costs/'.$logUnitCost->id
        );

        $this->assertApiResponse($logUnitCost->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_unit_cost()
    {
        $logUnitCost = log_unit_cost::factory()->create();
        $editedlog_unit_cost = log_unit_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_unit_costs/'.$logUnitCost->id,
            $editedlog_unit_cost
        );

        $this->assertApiResponse($editedlog_unit_cost);
    }

    /**
     * @test
     */
    public function test_delete_log_unit_cost()
    {
        $logUnitCost = log_unit_cost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_unit_costs/'.$logUnitCost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_unit_costs/'.$logUnitCost->id
        );

        $this->response->assertStatus(404);
    }
}
