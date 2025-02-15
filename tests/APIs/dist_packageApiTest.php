<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\dist_package;

class dist_packageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_dist_package()
    {
        $distPackage = dist_package::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/dist_packages', $distPackage
        );

        $this->assertApiResponse($distPackage);
    }

    /**
     * @test
     */
    public function test_read_dist_package()
    {
        $distPackage = dist_package::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/dist_packages/'.$distPackage->id
        );

        $this->assertApiResponse($distPackage->toArray());
    }

    /**
     * @test
     */
    public function test_update_dist_package()
    {
        $distPackage = dist_package::factory()->create();
        $editeddist_package = dist_package::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/dist_packages/'.$distPackage->id,
            $editeddist_package
        );

        $this->assertApiResponse($editeddist_package);
    }

    /**
     * @test
     */
    public function test_delete_dist_package()
    {
        $distPackage = dist_package::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/dist_packages/'.$distPackage->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/dist_packages/'.$distPackage->id
        );

        $this->response->assertStatus(404);
    }
}
