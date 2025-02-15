<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_cumi_lab_rate;

class log_cumi_lab_rateApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_cumi_lab_rate()
    {
        $logCumiLabRate = log_cumi_lab_rate::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_cumi_lab_rates', $logCumiLabRate
        );

        $this->assertApiResponse($logCumiLabRate);
    }

    /**
     * @test
     */
    public function test_read_log_cumi_lab_rate()
    {
        $logCumiLabRate = log_cumi_lab_rate::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_cumi_lab_rates/'.$logCumiLabRate->id
        );

        $this->assertApiResponse($logCumiLabRate->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_cumi_lab_rate()
    {
        $logCumiLabRate = log_cumi_lab_rate::factory()->create();
        $editedlog_cumi_lab_rate = log_cumi_lab_rate::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_cumi_lab_rates/'.$logCumiLabRate->id,
            $editedlog_cumi_lab_rate
        );

        $this->assertApiResponse($editedlog_cumi_lab_rate);
    }

    /**
     * @test
     */
    public function test_delete_log_cumi_lab_rate()
    {
        $logCumiLabRate = log_cumi_lab_rate::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_cumi_lab_rates/'.$logCumiLabRate->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_cumi_lab_rates/'.$logCumiLabRate->id
        );

        $this->response->assertStatus(404);
    }
}
