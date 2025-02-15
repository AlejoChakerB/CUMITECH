<?php namespace Tests\Repositories;

use App\Models\log_cext_details;
use App\Repositories\log_cext_detailsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_cext_detailsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_cext_detailsRepository
     */
    protected $logCextDetailsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logCextDetailsRepo = \App::make(log_cext_detailsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_cext_details()
    {
        $logCextDetails = log_cext_details::factory()->make()->toArray();

        $createdlog_cext_details = $this->logCextDetailsRepo->create($logCextDetails);

        $createdlog_cext_details = $createdlog_cext_details->toArray();
        $this->assertArrayHasKey('id', $createdlog_cext_details);
        $this->assertNotNull($createdlog_cext_details['id'], 'Created log_cext_details must have id specified');
        $this->assertNotNull(log_cext_details::find($createdlog_cext_details['id']), 'log_cext_details with given id must be in DB');
        $this->assertModelData($logCextDetails, $createdlog_cext_details);
    }

    /**
     * @test read
     */
    public function test_read_log_cext_details()
    {
        $logCextDetails = log_cext_details::factory()->create();

        $dblog_cext_details = $this->logCextDetailsRepo->find($logCextDetails->id);

        $dblog_cext_details = $dblog_cext_details->toArray();
        $this->assertModelData($logCextDetails->toArray(), $dblog_cext_details);
    }

    /**
     * @test update
     */
    public function test_update_log_cext_details()
    {
        $logCextDetails = log_cext_details::factory()->create();
        $fakelog_cext_details = log_cext_details::factory()->make()->toArray();

        $updatedlog_cext_details = $this->logCextDetailsRepo->update($fakelog_cext_details, $logCextDetails->id);

        $this->assertModelData($fakelog_cext_details, $updatedlog_cext_details->toArray());
        $dblog_cext_details = $this->logCextDetailsRepo->find($logCextDetails->id);
        $this->assertModelData($fakelog_cext_details, $dblog_cext_details->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_cext_details()
    {
        $logCextDetails = log_cext_details::factory()->create();

        $resp = $this->logCextDetailsRepo->delete($logCextDetails->id);

        $this->assertTrue($resp);
        $this->assertNull(log_cext_details::find($logCextDetails->id), 'log_cext_details should not exist in DB');
    }
}
