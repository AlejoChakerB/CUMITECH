<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_imaging_production_detail;

class log_imaging_production_detailApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_imaging_production_detail()
    {
        $logImagingProductionDetail = log_imaging_production_detail::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_imaging_production_details', $logImagingProductionDetail
        );

        $this->assertApiResponse($logImagingProductionDetail);
    }

    /**
     * @test
     */
    public function test_read_log_imaging_production_detail()
    {
        $logImagingProductionDetail = log_imaging_production_detail::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_imaging_production_details/'.$logImagingProductionDetail->id
        );

        $this->assertApiResponse($logImagingProductionDetail->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_imaging_production_detail()
    {
        $logImagingProductionDetail = log_imaging_production_detail::factory()->create();
        $editedlog_imaging_production_detail = log_imaging_production_detail::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_imaging_production_details/'.$logImagingProductionDetail->id,
            $editedlog_imaging_production_detail
        );

        $this->assertApiResponse($editedlog_imaging_production_detail);
    }

    /**
     * @test
     */
    public function test_delete_log_imaging_production_detail()
    {
        $logImagingProductionDetail = log_imaging_production_detail::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_imaging_production_details/'.$logImagingProductionDetail->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_imaging_production_details/'.$logImagingProductionDetail->id
        );

        $this->response->assertStatus(404);
    }
}
