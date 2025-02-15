<?php namespace Tests\Repositories;

use App\Models\presenter;
use App\Repositories\presenterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class presenterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var presenterRepository
     */
    protected $presenterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->presenterRepo = \App::make(presenterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_presenter()
    {
        $presenter = presenter::factory()->make()->toArray();

        $createdpresenter = $this->presenterRepo->create($presenter);

        $createdpresenter = $createdpresenter->toArray();
        $this->assertArrayHasKey('id', $createdpresenter);
        $this->assertNotNull($createdpresenter['id'], 'Created presenter must have id specified');
        $this->assertNotNull(presenter::find($createdpresenter['id']), 'presenter with given id must be in DB');
        $this->assertModelData($presenter, $createdpresenter);
    }

    /**
     * @test read
     */
    public function test_read_presenter()
    {
        $presenter = presenter::factory()->create();

        $dbpresenter = $this->presenterRepo->find($presenter->id);

        $dbpresenter = $dbpresenter->toArray();
        $this->assertModelData($presenter->toArray(), $dbpresenter);
    }

    /**
     * @test update
     */
    public function test_update_presenter()
    {
        $presenter = presenter::factory()->create();
        $fakepresenter = presenter::factory()->make()->toArray();

        $updatedpresenter = $this->presenterRepo->update($fakepresenter, $presenter->id);

        $this->assertModelData($fakepresenter, $updatedpresenter->toArray());
        $dbpresenter = $this->presenterRepo->find($presenter->id);
        $this->assertModelData($fakepresenter, $dbpresenter->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_presenter()
    {
        $presenter = presenter::factory()->create();

        $resp = $this->presenterRepo->delete($presenter->id);

        $this->assertTrue($resp);
        $this->assertNull(presenter::find($presenter->id), 'presenter should not exist in DB');
    }
}
