<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\employe;

class employeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_employe()
    {
        $employe = employe::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/employes', $employe
        );

        $this->assertApiResponse($employe);
    }

    /**
     * @test
     */
    public function test_read_employe()
    {
        $employe = employe::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/employes/'.$employe->id
        );

        $this->assertApiResponse($employe->toArray());
    }

    /**
     * @test
     */
    public function test_update_employe()
    {
        $employe = employe::factory()->create();
        $editedemploye = employe::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/employes/'.$employe->id,
            $editedemploye
        );

        $this->assertApiResponse($editedemploye);
    }

    /**
     * @test
     */
    public function test_delete_employe()
    {
        $employe = employe::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/employes/'.$employe->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/employes/'.$employe->id
        );

        $this->response->assertStatus(404);
    }
}
