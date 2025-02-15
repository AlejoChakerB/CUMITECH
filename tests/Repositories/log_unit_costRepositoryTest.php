<?php namespace Tests\Repositories;

use App\Models\log_unit_cost;
use App\Repositories\log_unit_costRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_unit_costRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_unit_costRepository
     */
    protected $logUnitCostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logUnitCostRepo = \App::make(log_unit_costRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_unit_cost()
    {
        $logUnitCost = log_unit_cost::factory()->make()->toArray();

        $createdlog_unit_cost = $this->logUnitCostRepo->create($logUnitCost);

        $createdlog_unit_cost = $createdlog_unit_cost->toArray();
        $this->assertArrayHasKey('id', $createdlog_unit_cost);
        $this->assertNotNull($createdlog_unit_cost['id'], 'Created log_unit_cost must have id specified');
        $this->assertNotNull(log_unit_cost::find($createdlog_unit_cost['id']), 'log_unit_cost with given id must be in DB');
        $this->assertModelData($logUnitCost, $createdlog_unit_cost);
    }

    /**
     * @test read
     */
    public function test_read_log_unit_cost()
    {
        $logUnitCost = log_unit_cost::factory()->create();

        $dblog_unit_cost = $this->logUnitCostRepo->find($logUnitCost->id);

        $dblog_unit_cost = $dblog_unit_cost->toArray();
        $this->assertModelData($logUnitCost->toArray(), $dblog_unit_cost);
    }

    /**
     * @test update
     */
    public function test_update_log_unit_cost()
    {
        $logUnitCost = log_unit_cost::factory()->create();
        $fakelog_unit_cost = log_unit_cost::factory()->make()->toArray();

        $updatedlog_unit_cost = $this->logUnitCostRepo->update($fakelog_unit_cost, $logUnitCost->id);

        $this->assertModelData($fakelog_unit_cost, $updatedlog_unit_cost->toArray());
        $dblog_unit_cost = $this->logUnitCostRepo->find($logUnitCost->id);
        $this->assertModelData($fakelog_unit_cost, $dblog_unit_cost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_unit_cost()
    {
        $logUnitCost = log_unit_cost::factory()->create();

        $resp = $this->logUnitCostRepo->delete($logUnitCost->id);

        $this->assertTrue($resp);
        $this->assertNull(log_unit_cost::find($logUnitCost->id), 'log_unit_cost should not exist in DB');
    }
}
