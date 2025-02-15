<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\imaging_production_month;

class imaging_production_monthApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_imaging_production_month()
    {
        $imagingProductionMonth = imaging_production_month::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/imaging_production_months', $imagingProductionMonth
        );

        $this->assertApiResponse($imagingProductionMonth);
    }

    /**
     * @test
     */
    public function test_read_imaging_production_month()
    {
        $imagingProductionMonth = imaging_production_month::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/imaging_production_months/'.$imagingProductionMonth->id
        );

        $this->assertApiResponse($imagingProductionMonth->toArray());
    }

    /**
     * @test
     */
    public function test_update_imaging_production_month()
    {
        $imagingProductionMonth = imaging_production_month::factory()->create();
        $editedimaging_production_month = imaging_production_month::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/imaging_production_months/'.$imagingProductionMonth->id,
            $editedimaging_production_month
        );

        $this->assertApiResponse($editedimaging_production_month);
    }

    /**
     * @test
     */
    public function test_delete_imaging_production_month()
    {
        $imagingProductionMonth = imaging_production_month::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/imaging_production_months/'.$imagingProductionMonth->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/imaging_production_months/'.$imagingProductionMonth->id
        );

        $this->response->assertStatus(404);
    }
}
