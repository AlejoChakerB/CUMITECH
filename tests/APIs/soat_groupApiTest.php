<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\soat_group;

class soat_groupApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_soat_group()
    {
        $soatGroup = soat_group::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/soat_groups', $soatGroup
        );

        $this->assertApiResponse($soatGroup);
    }

    /**
     * @test
     */
    public function test_read_soat_group()
    {
        $soatGroup = soat_group::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/soat_groups/'.$soatGroup->id
        );

        $this->assertApiResponse($soatGroup->toArray());
    }

    /**
     * @test
     */
    public function test_update_soat_group()
    {
        $soatGroup = soat_group::factory()->create();
        $editedsoat_group = soat_group::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/soat_groups/'.$soatGroup->id,
            $editedsoat_group
        );

        $this->assertApiResponse($editedsoat_group);
    }

    /**
     * @test
     */
    public function test_delete_soat_group()
    {
        $soatGroup = soat_group::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/soat_groups/'.$soatGroup->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/soat_groups/'.$soatGroup->id
        );

        $this->response->assertStatus(404);
    }
}
