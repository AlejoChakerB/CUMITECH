<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\articles;

class articlesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_articles()
    {
        $articles = articles::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/articles', $articles
        );

        $this->assertApiResponse($articles);
    }

    /**
     * @test
     */
    public function test_read_articles()
    {
        $articles = articles::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/articles/'.$articles->id
        );

        $this->assertApiResponse($articles->toArray());
    }

    /**
     * @test
     */
    public function test_update_articles()
    {
        $articles = articles::factory()->create();
        $editedarticles = articles::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/articles/'.$articles->id,
            $editedarticles
        );

        $this->assertApiResponse($editedarticles);
    }

    /**
     * @test
     */
    public function test_delete_articles()
    {
        $articles = articles::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/articles/'.$articles->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/articles/'.$articles->id
        );

        $this->response->assertStatus(404);
    }
}
