<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\basket;

class basketApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_basket()
    {
        $basket = basket::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/baskets', $basket
        );

        $this->assertApiResponse($basket);
    }

    /**
     * @test
     */
    public function test_read_basket()
    {
        $basket = basket::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/baskets/'.$basket->id
        );

        $this->assertApiResponse($basket->toArray());
    }

    /**
     * @test
     */
    public function test_update_basket()
    {
        $basket = basket::factory()->create();
        $editedbasket = basket::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/baskets/'.$basket->id,
            $editedbasket
        );

        $this->assertApiResponse($editedbasket);
    }

    /**
     * @test
     */
    public function test_delete_basket()
    {
        $basket = basket::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/baskets/'.$basket->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/baskets/'.$basket->id
        );

        $this->response->assertStatus(404);
    }
}
