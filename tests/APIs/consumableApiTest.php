<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\consumable;

class consumableApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_consumable()
    {
        $consumable = consumable::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/consumables', $consumable
        );

        $this->assertApiResponse($consumable);
    }

    /**
     * @test
     */
    public function test_read_consumable()
    {
        $consumable = consumable::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/consumables/'.$consumable->id
        );

        $this->assertApiResponse($consumable->toArray());
    }

    /**
     * @test
     */
    public function test_update_consumable()
    {
        $consumable = consumable::factory()->create();
        $editedconsumable = consumable::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/consumables/'.$consumable->id,
            $editedconsumable
        );

        $this->assertApiResponse($editedconsumable);
    }

    /**
     * @test
     */
    public function test_delete_consumable()
    {
        $consumable = consumable::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/consumables/'.$consumable->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/consumables/'.$consumable->id
        );

        $this->response->assertStatus(404);
    }
}
