<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\presenter;

class presenterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_presenter()
    {
        $presenter = presenter::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/presenters', $presenter
        );

        $this->assertApiResponse($presenter);
    }

    /**
     * @test
     */
    public function test_read_presenter()
    {
        $presenter = presenter::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/presenters/'.$presenter->id
        );

        $this->assertApiResponse($presenter->toArray());
    }

    /**
     * @test
     */
    public function test_update_presenter()
    {
        $presenter = presenter::factory()->create();
        $editedpresenter = presenter::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/presenters/'.$presenter->id,
            $editedpresenter
        );

        $this->assertApiResponse($editedpresenter);
    }

    /**
     * @test
     */
    public function test_delete_presenter()
    {
        $presenter = presenter::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/presenters/'.$presenter->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/presenters/'.$presenter->id
        );

        $this->response->assertStatus(404);
    }
}
