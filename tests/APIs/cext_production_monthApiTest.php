<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\cext_production_month;

class cext_production_monthApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cext_production_month()
    {
        $cextProductionMonth = cext_production_month::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cext_production_months', $cextProductionMonth
        );

        $this->assertApiResponse($cextProductionMonth);
    }

    /**
     * @test
     */
    public function test_read_cext_production_month()
    {
        $cextProductionMonth = cext_production_month::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cext_production_months/'.$cextProductionMonth->id
        );

        $this->assertApiResponse($cextProductionMonth->toArray());
    }

    /**
     * @test
     */
    public function test_update_cext_production_month()
    {
        $cextProductionMonth = cext_production_month::factory()->create();
        $editedcext_production_month = cext_production_month::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cext_production_months/'.$cextProductionMonth->id,
            $editedcext_production_month
        );

        $this->assertApiResponse($editedcext_production_month);
    }

    /**
     * @test
     */
    public function test_delete_cext_production_month()
    {
        $cextProductionMonth = cext_production_month::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cext_production_months/'.$cextProductionMonth->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cext_production_months/'.$cextProductionMonth->id
        );

        $this->response->assertStatus(404);
    }
}
