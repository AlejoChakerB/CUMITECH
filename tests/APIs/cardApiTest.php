<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\card;

class cardApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_card()
    {
        $card = card::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cards', $card
        );

        $this->assertApiResponse($card);
    }

    /**
     * @test
     */
    public function test_read_card()
    {
        $card = card::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cards/'.$card->id
        );

        $this->assertApiResponse($card->toArray());
    }

    /**
     * @test
     */
    public function test_update_card()
    {
        $card = card::factory()->create();
        $editedcard = card::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cards/'.$card->id,
            $editedcard
        );

        $this->assertApiResponse($editedcard);
    }

    /**
     * @test
     */
    public function test_delete_card()
    {
        $card = card::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cards/'.$card->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cards/'.$card->id
        );

        $this->response->assertStatus(404);
    }
}
