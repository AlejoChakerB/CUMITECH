<?php namespace Tests\Repositories;

use App\Models\articles;
use App\Repositories\articlesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class articlesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var articlesRepository
     */
    protected $articlesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->articlesRepo = \App::make(articlesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_articles()
    {
        $articles = articles::factory()->make()->toArray();

        $createdarticles = $this->articlesRepo->create($articles);

        $createdarticles = $createdarticles->toArray();
        $this->assertArrayHasKey('id', $createdarticles);
        $this->assertNotNull($createdarticles['id'], 'Created articles must have id specified');
        $this->assertNotNull(articles::find($createdarticles['id']), 'articles with given id must be in DB');
        $this->assertModelData($articles, $createdarticles);
    }

    /**
     * @test read
     */
    public function test_read_articles()
    {
        $articles = articles::factory()->create();

        $dbarticles = $this->articlesRepo->find($articles->id);

        $dbarticles = $dbarticles->toArray();
        $this->assertModelData($articles->toArray(), $dbarticles);
    }

    /**
     * @test update
     */
    public function test_update_articles()
    {
        $articles = articles::factory()->create();
        $fakearticles = articles::factory()->make()->toArray();

        $updatedarticles = $this->articlesRepo->update($fakearticles, $articles->id);

        $this->assertModelData($fakearticles, $updatedarticles->toArray());
        $dbarticles = $this->articlesRepo->find($articles->id);
        $this->assertModelData($fakearticles, $dbarticles->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_articles()
    {
        $articles = articles::factory()->create();

        $resp = $this->articlesRepo->delete($articles->id);

        $this->assertTrue($resp);
        $this->assertNull(articles::find($articles->id), 'articles should not exist in DB');
    }
}
