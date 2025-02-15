<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\imaging_production_details;

class imaging_production_detailsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_imaging_production_details()
    {
        $imagingProductionDetails = imaging_production_details::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/imaging_production_details', $imagingProductionDetails
        );

        $this->assertApiResponse($imagingProductionDetails);
    }

    /**
     * @test
     */
    public function test_read_imaging_production_details()
    {
        $imagingProductionDetails = imaging_production_details::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/imaging_production_details/'.$imagingProductionDetails->id
        );

        $this->assertApiResponse($imagingProductionDetails->toArray());
    }

    /**
     * @test
     */
    public function test_update_imaging_production_details()
    {
        $imagingProductionDetails = imaging_production_details::factory()->create();
        $editedimaging_production_details = imaging_production_details::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/imaging_production_details/'.$imagingProductionDetails->id,
            $editedimaging_production_details
        );

        $this->assertApiResponse($editedimaging_production_details);
    }

    /**
     * @test
     */
    public function test_delete_imaging_production_details()
    {
        $imagingProductionDetails = imaging_production_details::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/imaging_production_details/'.$imagingProductionDetails->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/imaging_production_details/'.$imagingProductionDetails->id
        );

        $this->response->assertStatus(404);
    }
}
