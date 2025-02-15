<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\multiple_surgery;

class multiple_surgeryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_multiple_surgery()
    {
        $multipleSurgery = multiple_surgery::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/multiple_surgeries', $multipleSurgery
        );

        $this->assertApiResponse($multipleSurgery);
    }

    /**
     * @test
     */
    public function test_read_multiple_surgery()
    {
        $multipleSurgery = multiple_surgery::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/multiple_surgeries/'.$multipleSurgery->id
        );

        $this->assertApiResponse($multipleSurgery->toArray());
    }

    /**
     * @test
     */
    public function test_update_multiple_surgery()
    {
        $multipleSurgery = multiple_surgery::factory()->create();
        $editedmultiple_surgery = multiple_surgery::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/multiple_surgeries/'.$multipleSurgery->id,
            $editedmultiple_surgery
        );

        $this->assertApiResponse($editedmultiple_surgery);
    }

    /**
     * @test
     */
    public function test_delete_multiple_surgery()
    {
        $multipleSurgery = multiple_surgery::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/multiple_surgeries/'.$multipleSurgery->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/multiple_surgeries/'.$multipleSurgery->id
        );

        $this->response->assertStatus(404);
    }
}
