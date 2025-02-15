<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ambulance_cost;

class ambulance_costApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ambulance_cost()
    {
        $ambulanceCost = ambulance_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ambulance_costs', $ambulanceCost
        );

        $this->assertApiResponse($ambulanceCost);
    }

    /**
     * @test
     */
    public function test_read_ambulance_cost()
    {
        $ambulanceCost = ambulance_cost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/ambulance_costs/'.$ambulanceCost->id
        );

        $this->assertApiResponse($ambulanceCost->toArray());
    }

    /**
     * @test
     */
    public function test_update_ambulance_cost()
    {
        $ambulanceCost = ambulance_cost::factory()->create();
        $editedambulance_cost = ambulance_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ambulance_costs/'.$ambulanceCost->id,
            $editedambulance_cost
        );

        $this->assertApiResponse($editedambulance_cost);
    }

    /**
     * @test
     */
    public function test_delete_ambulance_cost()
    {
        $ambulanceCost = ambulance_cost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ambulance_costs/'.$ambulanceCost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ambulance_costs/'.$ambulanceCost->id
        );

        $this->response->assertStatus(404);
    }
}
