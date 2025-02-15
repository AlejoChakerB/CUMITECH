<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_details_unitCost;

class log_details_unitCostApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_details_unit_cost()
    {
        $logDetailsUnitCost = log_details_unitCost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_details_unit_costs', $logDetailsUnitCost
        );

        $this->assertApiResponse($logDetailsUnitCost);
    }

    /**
     * @test
     */
    public function test_read_log_details_unit_cost()
    {
        $logDetailsUnitCost = log_details_unitCost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_details_unit_costs/'.$logDetailsUnitCost->id
        );

        $this->assertApiResponse($logDetailsUnitCost->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_details_unit_cost()
    {
        $logDetailsUnitCost = log_details_unitCost::factory()->create();
        $editedlog_details_unitCost = log_details_unitCost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_details_unit_costs/'.$logDetailsUnitCost->id,
            $editedlog_details_unitCost
        );

        $this->assertApiResponse($editedlog_details_unitCost);
    }

    /**
     * @test
     */
    public function test_delete_log_details_unit_cost()
    {
        $logDetailsUnitCost = log_details_unitCost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_details_unit_costs/'.$logDetailsUnitCost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_details_unit_costs/'.$logDetailsUnitCost->id
        );

        $this->response->assertStatus(404);
    }
}
