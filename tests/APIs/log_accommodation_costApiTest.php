<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_accommodation_cost;

class log_accommodation_costApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_accommodation_cost()
    {
        $logAccommodationCost = log_accommodation_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_accommodation_costs', $logAccommodationCost
        );

        $this->assertApiResponse($logAccommodationCost);
    }

    /**
     * @test
     */
    public function test_read_log_accommodation_cost()
    {
        $logAccommodationCost = log_accommodation_cost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_accommodation_costs/'.$logAccommodationCost->id
        );

        $this->assertApiResponse($logAccommodationCost->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_accommodation_cost()
    {
        $logAccommodationCost = log_accommodation_cost::factory()->create();
        $editedlog_accommodation_cost = log_accommodation_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_accommodation_costs/'.$logAccommodationCost->id,
            $editedlog_accommodation_cost
        );

        $this->assertApiResponse($editedlog_accommodation_cost);
    }

    /**
     * @test
     */
    public function test_delete_log_accommodation_cost()
    {
        $logAccommodationCost = log_accommodation_cost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_accommodation_costs/'.$logAccommodationCost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_accommodation_costs/'.$logAccommodationCost->id
        );

        $this->response->assertStatus(404);
    }
}
