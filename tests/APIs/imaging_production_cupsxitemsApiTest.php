<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\imaging_production_cupsxitems;

class imaging_production_cupsxitemsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_imaging_production_cupsxitems()
    {
        $imagingProductionCupsxitems = imaging_production_cupsxitems::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/imaging_production_cupsxitems', $imagingProductionCupsxitems
        );

        $this->assertApiResponse($imagingProductionCupsxitems);
    }

    /**
     * @test
     */
    public function test_read_imaging_production_cupsxitems()
    {
        $imagingProductionCupsxitems = imaging_production_cupsxitems::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/imaging_production_cupsxitems/'.$imagingProductionCupsxitems->id
        );

        $this->assertApiResponse($imagingProductionCupsxitems->toArray());
    }

    /**
     * @test
     */
    public function test_update_imaging_production_cupsxitems()
    {
        $imagingProductionCupsxitems = imaging_production_cupsxitems::factory()->create();
        $editedimaging_production_cupsxitems = imaging_production_cupsxitems::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/imaging_production_cupsxitems/'.$imagingProductionCupsxitems->id,
            $editedimaging_production_cupsxitems
        );

        $this->assertApiResponse($editedimaging_production_cupsxitems);
    }

    /**
     * @test
     */
    public function test_delete_imaging_production_cupsxitems()
    {
        $imagingProductionCupsxitems = imaging_production_cupsxitems::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/imaging_production_cupsxitems/'.$imagingProductionCupsxitems->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/imaging_production_cupsxitems/'.$imagingProductionCupsxitems->id
        );

        $this->response->assertStatus(404);
    }
}
