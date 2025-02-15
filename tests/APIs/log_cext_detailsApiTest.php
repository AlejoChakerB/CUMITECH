<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_cext_details;

class log_cext_detailsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_cext_details()
    {
        $logCextDetails = log_cext_details::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_cext_details', $logCextDetails
        );

        $this->assertApiResponse($logCextDetails);
    }

    /**
     * @test
     */
    public function test_read_log_cext_details()
    {
        $logCextDetails = log_cext_details::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_cext_details/'.$logCextDetails->id
        );

        $this->assertApiResponse($logCextDetails->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_cext_details()
    {
        $logCextDetails = log_cext_details::factory()->create();
        $editedlog_cext_details = log_cext_details::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_cext_details/'.$logCextDetails->id,
            $editedlog_cext_details
        );

        $this->assertApiResponse($editedlog_cext_details);
    }

    /**
     * @test
     */
    public function test_delete_log_cext_details()
    {
        $logCextDetails = log_cext_details::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_cext_details/'.$logCextDetails->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_cext_details/'.$logCextDetails->id
        );

        $this->response->assertStatus(404);
    }
}
