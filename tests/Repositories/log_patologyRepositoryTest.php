<?php namespace Tests\Repositories;

use App\Models\log_patology;
use App\Repositories\log_patologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_patologyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_patologyRepository
     */
    protected $logPatologyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logPatologyRepo = \App::make(log_patologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_patology()
    {
        $logPatology = log_patology::factory()->make()->toArray();

        $createdlog_patology = $this->logPatologyRepo->create($logPatology);

        $createdlog_patology = $createdlog_patology->toArray();
        $this->assertArrayHasKey('id', $createdlog_patology);
        $this->assertNotNull($createdlog_patology['id'], 'Created log_patology must have id specified');
        $this->assertNotNull(log_patology::find($createdlog_patology['id']), 'log_patology with given id must be in DB');
        $this->assertModelData($logPatology, $createdlog_patology);
    }

    /**
     * @test read
     */
    public function test_read_log_patology()
    {
        $logPatology = log_patology::factory()->create();

        $dblog_patology = $this->logPatologyRepo->find($logPatology->id);

        $dblog_patology = $dblog_patology->toArray();
        $this->assertModelData($logPatology->toArray(), $dblog_patology);
    }

    /**
     * @test update
     */
    public function test_update_log_patology()
    {
        $logPatology = log_patology::factory()->create();
        $fakelog_patology = log_patology::factory()->make()->toArray();

        $updatedlog_patology = $this->logPatologyRepo->update($fakelog_patology, $logPatology->id);

        $this->assertModelData($fakelog_patology, $updatedlog_patology->toArray());
        $dblog_patology = $this->logPatologyRepo->find($logPatology->id);
        $this->assertModelData($fakelog_patology, $dblog_patology->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_patology()
    {
        $logPatology = log_patology::factory()->create();

        $resp = $this->logPatologyRepo->delete($logPatology->id);

        $this->assertTrue($resp);
        $this->assertNull(log_patology::find($logPatology->id), 'log_patology should not exist in DB');
    }
}
