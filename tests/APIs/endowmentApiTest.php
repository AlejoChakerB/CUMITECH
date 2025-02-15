<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\endowment;

class endowmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_endowment()
    {
        $endowment = endowment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/endowments', $endowment
        );

        $this->assertApiResponse($endowment);
    }

    /**
     * @test
     */
    public function test_read_endowment()
    {
        $endowment = endowment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/endowments/'.$endowment->id
        );

        $this->assertApiResponse($endowment->toArray());
    }

    /**
     * @test
     */
    public function test_update_endowment()
    {
        $endowment = endowment::factory()->create();
        $editedendowment = endowment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/endowments/'.$endowment->id,
            $editedendowment
        );

        $this->assertApiResponse($editedendowment);
    }

    /**
     * @test
     */
    public function test_delete_endowment()
    {
        $endowment = endowment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/endowments/'.$endowment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/endowments/'.$endowment->id
        );

        $this->response->assertStatus(404);
    }
}
