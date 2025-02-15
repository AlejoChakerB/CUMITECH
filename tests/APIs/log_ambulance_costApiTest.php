<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_ambulance_cost;

class log_ambulance_costApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_ambulance_cost()
    {
        $logAmbulanceCost = log_ambulance_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_ambulance_costs', $logAmbulanceCost
        );

        $this->assertApiResponse($logAmbulanceCost);
    }

    /**
     * @test
     */
    public function test_read_log_ambulance_cost()
    {
        $logAmbulanceCost = log_ambulance_cost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_ambulance_costs/'.$logAmbulanceCost->id
        );

        $this->assertApiResponse($logAmbulanceCost->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_ambulance_cost()
    {
        $logAmbulanceCost = log_ambulance_cost::factory()->create();
        $editedlog_ambulance_cost = log_ambulance_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_ambulance_costs/'.$logAmbulanceCost->id,
            $editedlog_ambulance_cost
        );

        $this->assertApiResponse($editedlog_ambulance_cost);
    }

    /**
     * @test
     */
    public function test_delete_log_ambulance_cost()
    {
        $logAmbulanceCost = log_ambulance_cost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_ambulance_costs/'.$logAmbulanceCost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_ambulance_costs/'.$logAmbulanceCost->id
        );

        $this->response->assertStatus(404);
    }
}
