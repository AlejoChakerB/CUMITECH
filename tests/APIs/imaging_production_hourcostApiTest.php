<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\imaging_production_hourcost;

class imaging_production_hourcostApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_imaging_production_hourcost()
    {
        $imagingProductionHourcost = imaging_production_hourcost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/imaging_production_hourcosts', $imagingProductionHourcost
        );

        $this->assertApiResponse($imagingProductionHourcost);
    }

    /**
     * @test
     */
    public function test_read_imaging_production_hourcost()
    {
        $imagingProductionHourcost = imaging_production_hourcost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/imaging_production_hourcosts/'.$imagingProductionHourcost->id
        );

        $this->assertApiResponse($imagingProductionHourcost->toArray());
    }

    /**
     * @test
     */
    public function test_update_imaging_production_hourcost()
    {
        $imagingProductionHourcost = imaging_production_hourcost::factory()->create();
        $editedimaging_production_hourcost = imaging_production_hourcost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/imaging_production_hourcosts/'.$imagingProductionHourcost->id,
            $editedimaging_production_hourcost
        );

        $this->assertApiResponse($editedimaging_production_hourcost);
    }

    /**
     * @test
     */
    public function test_delete_imaging_production_hourcost()
    {
        $imagingProductionHourcost = imaging_production_hourcost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/imaging_production_hourcosts/'.$imagingProductionHourcost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/imaging_production_hourcosts/'.$imagingProductionHourcost->id
        );

        $this->response->assertStatus(404);
    }
}
