<?php namespace Tests\Repositories;

use App\Models\log_operation_cost;
use App\Repositories\log_operation_costRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_operation_costRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_operation_costRepository
     */
    protected $logOperationCostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logOperationCostRepo = \App::make(log_operation_costRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_operation_cost()
    {
        $logOperationCost = log_operation_cost::factory()->make()->toArray();

        $createdlog_operation_cost = $this->logOperationCostRepo->create($logOperationCost);

        $createdlog_operation_cost = $createdlog_operation_cost->toArray();
        $this->assertArrayHasKey('id', $createdlog_operation_cost);
        $this->assertNotNull($createdlog_operation_cost['id'], 'Created log_operation_cost must have id specified');
        $this->assertNotNull(log_operation_cost::find($createdlog_operation_cost['id']), 'log_operation_cost with given id must be in DB');
        $this->assertModelData($logOperationCost, $createdlog_operation_cost);
    }

    /**
     * @test read
     */
    public function test_read_log_operation_cost()
    {
        $logOperationCost = log_operation_cost::factory()->create();

        $dblog_operation_cost = $this->logOperationCostRepo->find($logOperationCost->id);

        $dblog_operation_cost = $dblog_operation_cost->toArray();
        $this->assertModelData($logOperationCost->toArray(), $dblog_operation_cost);
    }

    /**
     * @test update
     */
    public function test_update_log_operation_cost()
    {
        $logOperationCost = log_operation_cost::factory()->create();
        $fakelog_operation_cost = log_operation_cost::factory()->make()->toArray();

        $updatedlog_operation_cost = $this->logOperationCostRepo->update($fakelog_operation_cost, $logOperationCost->id);

        $this->assertModelData($fakelog_operation_cost, $updatedlog_operation_cost->toArray());
        $dblog_operation_cost = $this->logOperationCostRepo->find($logOperationCost->id);
        $this->assertModelData($fakelog_operation_cost, $dblog_operation_cost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_operation_cost()
    {
        $logOperationCost = log_operation_cost::factory()->create();

        $resp = $this->logOperationCostRepo->delete($logOperationCost->id);

        $this->assertTrue($resp);
        $this->assertNull(log_operation_cost::find($logOperationCost->id), 'log_operation_cost should not exist in DB');
    }
}
