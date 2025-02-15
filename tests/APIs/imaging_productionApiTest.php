<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\imaging_production;

class imaging_productionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_imaging_production()
    {
        $imagingProduction = imaging_production::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/imaging_productions', $imagingProduction
        );

        $this->assertApiResponse($imagingProduction);
    }

    /**
     * @test
     */
    public function test_read_imaging_production()
    {
        $imagingProduction = imaging_production::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/imaging_productions/'.$imagingProduction->id
        );

        $this->assertApiResponse($imagingProduction->toArray());
    }

    /**
     * @test
     */
    public function test_update_imaging_production()
    {
        $imagingProduction = imaging_production::factory()->create();
        $editedimaging_production = imaging_production::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/imaging_productions/'.$imagingProduction->id,
            $editedimaging_production
        );

        $this->assertApiResponse($editedimaging_production);
    }

    /**
     * @test
     */
    public function test_delete_imaging_production()
    {
        $imagingProduction = imaging_production::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/imaging_productions/'.$imagingProduction->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/imaging_productions/'.$imagingProduction->id
        );

        $this->response->assertStatus(404);
    }
}
