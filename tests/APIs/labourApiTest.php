<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\labour;

class labourApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_labour()
    {
        $labour = labour::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/labours', $labour
        );

        $this->assertApiResponse($labour);
    }

    /**
     * @test
     */
    public function test_read_labour()
    {
        $labour = labour::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/labours/'.$labour->id
        );

        $this->assertApiResponse($labour->toArray());
    }

    /**
     * @test
     */
    public function test_update_labour()
    {
        $labour = labour::factory()->create();
        $editedlabour = labour::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/labours/'.$labour->id,
            $editedlabour
        );

        $this->assertApiResponse($editedlabour);
    }

    /**
     * @test
     */
    public function test_delete_labour()
    {
        $labour = labour::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/labours/'.$labour->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/labours/'.$labour->id
        );

        $this->response->assertStatus(404);
    }
}
