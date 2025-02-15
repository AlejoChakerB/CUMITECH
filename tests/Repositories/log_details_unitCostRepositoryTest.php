<?php namespace Tests\Repositories;

use App\Models\log_details_unitCost;
use App\Repositories\log_details_unitCostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_details_unitCostRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_details_unitCostRepository
     */
    protected $logDetailsUnitCostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logDetailsUnitCostRepo = \App::make(log_details_unitCostRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_details_unit_cost()
    {
        $logDetailsUnitCost = log_details_unitCost::factory()->make()->toArray();

        $createdlog_details_unitCost = $this->logDetailsUnitCostRepo->create($logDetailsUnitCost);

        $createdlog_details_unitCost = $createdlog_details_unitCost->toArray();
        $this->assertArrayHasKey('id', $createdlog_details_unitCost);
        $this->assertNotNull($createdlog_details_unitCost['id'], 'Created log_details_unitCost must have id specified');
        $this->assertNotNull(log_details_unitCost::find($createdlog_details_unitCost['id']), 'log_details_unitCost with given id must be in DB');
        $this->assertModelData($logDetailsUnitCost, $createdlog_details_unitCost);
    }

    /**
     * @test read
     */
    public function test_read_log_details_unit_cost()
    {
        $logDetailsUnitCost = log_details_unitCost::factory()->create();

        $dblog_details_unitCost = $this->logDetailsUnitCostRepo->find($logDetailsUnitCost->id);

        $dblog_details_unitCost = $dblog_details_unitCost->toArray();
        $this->assertModelData($logDetailsUnitCost->toArray(), $dblog_details_unitCost);
    }

    /**
     * @test update
     */
    public function test_update_log_details_unit_cost()
    {
        $logDetailsUnitCost = log_details_unitCost::factory()->create();
        $fakelog_details_unitCost = log_details_unitCost::factory()->make()->toArray();

        $updatedlog_details_unitCost = $this->logDetailsUnitCostRepo->update($fakelog_details_unitCost, $logDetailsUnitCost->id);

        $this->assertModelData($fakelog_details_unitCost, $updatedlog_details_unitCost->toArray());
        $dblog_details_unitCost = $this->logDetailsUnitCostRepo->find($logDetailsUnitCost->id);
        $this->assertModelData($fakelog_details_unitCost, $dblog_details_unitCost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_details_unit_cost()
    {
        $logDetailsUnitCost = log_details_unitCost::factory()->create();

        $resp = $this->logDetailsUnitCostRepo->delete($logDetailsUnitCost->id);

        $this->assertTrue($resp);
        $this->assertNull(log_details_unitCost::find($logDetailsUnitCost->id), 'log_details_unitCost should not exist in DB');
    }
}
