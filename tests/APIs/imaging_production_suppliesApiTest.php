<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\imaging_production_supplies;

class imaging_production_suppliesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_imaging_production_supplies()
    {
        $imagingProductionSupplies = imaging_production_supplies::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/imaging_production_supplies', $imagingProductionSupplies
        );

        $this->assertApiResponse($imagingProductionSupplies);
    }

    /**
     * @test
     */
    public function test_read_imaging_production_supplies()
    {
        $imagingProductionSupplies = imaging_production_supplies::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/imaging_production_supplies/'.$imagingProductionSupplies->id
        );

        $this->assertApiResponse($imagingProductionSupplies->toArray());
    }

    /**
     * @test
     */
    public function test_update_imaging_production_supplies()
    {
        $imagingProductionSupplies = imaging_production_supplies::factory()->create();
        $editedimaging_production_supplies = imaging_production_supplies::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/imaging_production_supplies/'.$imagingProductionSupplies->id,
            $editedimaging_production_supplies
        );

        $this->assertApiResponse($editedimaging_production_supplies);
    }

    /**
     * @test
     */
    public function test_delete_imaging_production_supplies()
    {
        $imagingProductionSupplies = imaging_production_supplies::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/imaging_production_supplies/'.$imagingProductionSupplies->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/imaging_production_supplies/'.$imagingProductionSupplies->id
        );

        $this->response->assertStatus(404);
    }
}
