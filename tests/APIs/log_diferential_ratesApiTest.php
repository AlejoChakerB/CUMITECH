<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_diferential_rates;

class log_diferential_ratesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_diferential_rates()
    {
        $logDiferentialRates = log_diferential_rates::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_diferential_rates', $logDiferentialRates
        );

        $this->assertApiResponse($logDiferentialRates);
    }

    /**
     * @test
     */
    public function test_read_log_diferential_rates()
    {
        $logDiferentialRates = log_diferential_rates::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_diferential_rates/'.$logDiferentialRates->id
        );

        $this->assertApiResponse($logDiferentialRates->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_diferential_rates()
    {
        $logDiferentialRates = log_diferential_rates::factory()->create();
        $editedlog_diferential_rates = log_diferential_rates::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_diferential_rates/'.$logDiferentialRates->id,
            $editedlog_diferential_rates
        );

        $this->assertApiResponse($editedlog_diferential_rates);
    }

    /**
     * @test
     */
    public function test_delete_log_diferential_rates()
    {
        $logDiferentialRates = log_diferential_rates::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_diferential_rates/'.$logDiferentialRates->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_diferential_rates/'.$logDiferentialRates->id
        );

        $this->response->assertStatus(404);
    }
}
