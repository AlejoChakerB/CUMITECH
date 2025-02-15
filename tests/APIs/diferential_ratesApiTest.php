<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\diferential_rates;

class diferential_ratesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_diferential_rates()
    {
        $diferentialRates = diferential_rates::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/diferential_rates', $diferentialRates
        );

        $this->assertApiResponse($diferentialRates);
    }

    /**
     * @test
     */
    public function test_read_diferential_rates()
    {
        $diferentialRates = diferential_rates::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/diferential_rates/'.$diferentialRates->id
        );

        $this->assertApiResponse($diferentialRates->toArray());
    }

    /**
     * @test
     */
    public function test_update_diferential_rates()
    {
        $diferentialRates = diferential_rates::factory()->create();
        $editeddiferential_rates = diferential_rates::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/diferential_rates/'.$diferentialRates->id,
            $editeddiferential_rates
        );

        $this->assertApiResponse($editeddiferential_rates);
    }

    /**
     * @test
     */
    public function test_delete_diferential_rates()
    {
        $diferentialRates = diferential_rates::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/diferential_rates/'.$diferentialRates->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/diferential_rates/'.$diferentialRates->id
        );

        $this->response->assertStatus(404);
    }
}
