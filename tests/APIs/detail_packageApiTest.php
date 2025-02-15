<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\detail_package;

class detail_packageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_detail_package()
    {
        $detailPackage = detail_package::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/detail_packages', $detailPackage
        );

        $this->assertApiResponse($detailPackage);
    }

    /**
     * @test
     */
    public function test_read_detail_package()
    {
        $detailPackage = detail_package::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/detail_packages/'.$detailPackage->id
        );

        $this->assertApiResponse($detailPackage->toArray());
    }

    /**
     * @test
     */
    public function test_update_detail_package()
    {
        $detailPackage = detail_package::factory()->create();
        $editeddetail_package = detail_package::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/detail_packages/'.$detailPackage->id,
            $editeddetail_package
        );

        $this->assertApiResponse($editeddetail_package);
    }

    /**
     * @test
     */
    public function test_delete_detail_package()
    {
        $detailPackage = detail_package::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/detail_packages/'.$detailPackage->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/detail_packages/'.$detailPackage->id
        );

        $this->response->assertStatus(404);
    }
}
