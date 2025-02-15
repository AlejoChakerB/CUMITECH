<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\accommodation_cost;

class accommodation_costApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_accommodation_cost()
    {
        $accommodationCost = accommodation_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/accommodation_costs', $accommodationCost
        );

        $this->assertApiResponse($accommodationCost);
    }

    /**
     * @test
     */
    public function test_read_accommodation_cost()
    {
        $accommodationCost = accommodation_cost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/accommodation_costs/'.$accommodationCost->id
        );

        $this->assertApiResponse($accommodationCost->toArray());
    }

    /**
     * @test
     */
    public function test_update_accommodation_cost()
    {
        $accommodationCost = accommodation_cost::factory()->create();
        $editedaccommodation_cost = accommodation_cost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/accommodation_costs/'.$accommodationCost->id,
            $editedaccommodation_cost
        );

        $this->assertApiResponse($editedaccommodation_cost);
    }

    /**
     * @test
     */
    public function test_delete_accommodation_cost()
    {
        $accommodationCost = accommodation_cost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/accommodation_costs/'.$accommodationCost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/accommodation_costs/'.$accommodationCost->id
        );

        $this->response->assertStatus(404);
    }
}
