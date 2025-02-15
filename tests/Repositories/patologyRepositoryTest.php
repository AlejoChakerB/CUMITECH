<?php namespace Tests\Repositories;

use App\Models\patology;
use App\Repositories\patologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class patologyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var patologyRepository
     */
    protected $patologyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->patologyRepo = \App::make(patologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_patology()
    {
        $patology = patology::factory()->make()->toArray();

        $createdpatology = $this->patologyRepo->create($patology);

        $createdpatology = $createdpatology->toArray();
        $this->assertArrayHasKey('id', $createdpatology);
        $this->assertNotNull($createdpatology['id'], 'Created patology must have id specified');
        $this->assertNotNull(patology::find($createdpatology['id']), 'patology with given id must be in DB');
        $this->assertModelData($patology, $createdpatology);
    }

    /**
     * @test read
     */
    public function test_read_patology()
    {
        $patology = patology::factory()->create();

        $dbpatology = $this->patologyRepo->find($patology->id);

        $dbpatology = $dbpatology->toArray();
        $this->assertModelData($patology->toArray(), $dbpatology);
    }

    /**
     * @test update
     */
    public function test_update_patology()
    {
        $patology = patology::factory()->create();
        $fakepatology = patology::factory()->make()->toArray();

        $updatedpatology = $this->patologyRepo->update($fakepatology, $patology->id);

        $this->assertModelData($fakepatology, $updatedpatology->toArray());
        $dbpatology = $this->patologyRepo->find($patology->id);
        $this->assertModelData($fakepatology, $dbpatology->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_patology()
    {
        $patology = patology::factory()->create();

        $resp = $this->patologyRepo->delete($patology->id);

        $this->assertTrue($resp);
        $this->assertNull(patology::find($patology->id), 'patology should not exist in DB');
    }
}
