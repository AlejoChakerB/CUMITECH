<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\general_costs;

class general_costsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_general_costs()
    {
        $generalCosts = general_costs::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/general_costs', $generalCosts
        );

        $this->assertApiResponse($generalCosts);
    }

    /**
     * @test
     */
    public function test_read_general_costs()
    {
        $generalCosts = general_costs::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/general_costs/'.$generalCosts->id
        );

        $this->assertApiResponse($generalCosts->toArray());
    }

    /**
     * @test
     */
    public function test_update_general_costs()
    {
        $generalCosts = general_costs::factory()->create();
        $editedgeneral_costs = general_costs::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/general_costs/'.$generalCosts->id,
            $editedgeneral_costs
        );

        $this->assertApiResponse($editedgeneral_costs);
    }

    /**
     * @test
     */
    public function test_delete_general_costs()
    {
        $generalCosts = general_costs::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/general_costs/'.$generalCosts->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/general_costs/'.$generalCosts->id
        );

        $this->response->assertStatus(404);
    }
}
