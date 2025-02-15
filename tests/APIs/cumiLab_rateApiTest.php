<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\cumiLab_rate;

class cumiLab_rateApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cumi_lab_rate()
    {
        $cumiLabRate = cumiLab_rate::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cumi_lab_rates', $cumiLabRate
        );

        $this->assertApiResponse($cumiLabRate);
    }

    /**
     * @test
     */
    public function test_read_cumi_lab_rate()
    {
        $cumiLabRate = cumiLab_rate::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cumi_lab_rates/'.$cumiLabRate->id
        );

        $this->assertApiResponse($cumiLabRate->toArray());
    }

    /**
     * @test
     */
    public function test_update_cumi_lab_rate()
    {
        $cumiLabRate = cumiLab_rate::factory()->create();
        $editedcumiLab_rate = cumiLab_rate::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cumi_lab_rates/'.$cumiLabRate->id,
            $editedcumiLab_rate
        );

        $this->assertApiResponse($editedcumiLab_rate);
    }

    /**
     * @test
     */
    public function test_delete_cumi_lab_rate()
    {
        $cumiLabRate = cumiLab_rate::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cumi_lab_rates/'.$cumiLabRate->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cumi_lab_rates/'.$cumiLabRate->id
        );

        $this->response->assertStatus(404);
    }
}
