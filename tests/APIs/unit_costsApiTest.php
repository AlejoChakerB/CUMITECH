<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\unit_costs;

class unit_costsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_unit_costs()
    {
        $unitCosts = unit_costs::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/unit_costs', $unitCosts
        );

        $this->assertApiResponse($unitCosts);
    }

    /**
     * @test
     */
    public function test_read_unit_costs()
    {
        $unitCosts = unit_costs::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/unit_costs/'.$unitCosts->id
        );

        $this->assertApiResponse($unitCosts->toArray());
    }

    /**
     * @test
     */
    public function test_update_unit_costs()
    {
        $unitCosts = unit_costs::factory()->create();
        $editedunit_costs = unit_costs::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/unit_costs/'.$unitCosts->id,
            $editedunit_costs
        );

        $this->assertApiResponse($editedunit_costs);
    }

    /**
     * @test
     */
    public function test_delete_unit_costs()
    {
        $unitCosts = unit_costs::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/unit_costs/'.$unitCosts->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/unit_costs/'.$unitCosts->id
        );

        $this->response->assertStatus(404);
    }
}
