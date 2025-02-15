<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\detail_packages_temp;

class detail_packages_tempApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detail_packages_temp()
    {
        $detailPackagesTemp = detail_packages_temp::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detail_packages_temps', $detailPackagesTemp
        );

        $this->assertApiResponse($detailPackagesTemp);
    }

    /**
     * @test
     */
    public function test_read_detail_packages_temp()
    {
        $detailPackagesTemp = detail_packages_temp::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/detail_packages_temps/'.$detailPackagesTemp->id
        );

        $this->assertApiResponse($detailPackagesTemp->toArray());
    }

    /**
     * @test
     */
    public function test_update_detail_packages_temp()
    {
        $detailPackagesTemp = detail_packages_temp::factory()->create();
        $editeddetail_packages_temp = detail_packages_temp::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detail_packages_temps/'.$detailPackagesTemp->id,
            $editeddetail_packages_temp
        );

        $this->assertApiResponse($editeddetail_packages_temp);
    }

    /**
     * @test
     */
    public function test_delete_detail_packages_temp()
    {
        $detailPackagesTemp = detail_packages_temp::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detail_packages_temps/'.$detailPackagesTemp->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detail_packages_temps/'.$detailPackagesTemp->id
        );

        $this->response->assertStatus(404);
    }
}
