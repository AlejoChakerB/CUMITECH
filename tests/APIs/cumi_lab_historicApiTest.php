<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\cumi_lab_historic;

class cumi_lab_historicApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cumi_lab_historic()
    {
        $cumiLabHistoric = cumi_lab_historic::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cumi_lab_historics', $cumiLabHistoric
        );

        $this->assertApiResponse($cumiLabHistoric);
    }

    /**
     * @test
     */
    public function test_read_cumi_lab_historic()
    {
        $cumiLabHistoric = cumi_lab_historic::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cumi_lab_historics/'.$cumiLabHistoric->id
        );

        $this->assertApiResponse($cumiLabHistoric->toArray());
    }

    /**
     * @test
     */
    public function test_update_cumi_lab_historic()
    {
        $cumiLabHistoric = cumi_lab_historic::factory()->create();
        $editedcumi_lab_historic = cumi_lab_historic::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cumi_lab_historics/'.$cumiLabHistoric->id,
            $editedcumi_lab_historic
        );

        $this->assertApiResponse($editedcumi_lab_historic);
    }

    /**
     * @test
     */
    public function test_delete_cumi_lab_historic()
    {
        $cumiLabHistoric = cumi_lab_historic::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cumi_lab_historics/'.$cumiLabHistoric->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cumi_lab_historics/'.$cumiLabHistoric->id
        );

        $this->response->assertStatus(404);
    }
}
