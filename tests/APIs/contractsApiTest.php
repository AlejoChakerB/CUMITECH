<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\contracts;

class contractsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contracts()
    {
        $contracts = contracts::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contracts', $contracts
        );

        $this->assertApiResponse($contracts);
    }

    /**
     * @test
     */
    public function test_read_contracts()
    {
        $contracts = contracts::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contracts/'.$contracts->id
        );

        $this->assertApiResponse($contracts->toArray());
    }

    /**
     * @test
     */
    public function test_update_contracts()
    {
        $contracts = contracts::factory()->create();
        $editedcontracts = contracts::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contracts/'.$contracts->id,
            $editedcontracts
        );

        $this->assertApiResponse($editedcontracts);
    }

    /**
     * @test
     */
    public function test_delete_contracts()
    {
        $contracts = contracts::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contracts/'.$contracts->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contracts/'.$contracts->id
        );

        $this->response->assertStatus(404);
    }
}
