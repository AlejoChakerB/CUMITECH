<?php namespace Tests\Repositories;

use App\Models\log_ambulance_cost;
use App\Repositories\log_ambulance_costRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_ambulance_costRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_ambulance_costRepository
     */
    protected $logAmbulanceCostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logAmbulanceCostRepo = \App::make(log_ambulance_costRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_ambulance_cost()
    {
        $logAmbulanceCost = log_ambulance_cost::factory()->make()->toArray();

        $createdlog_ambulance_cost = $this->logAmbulanceCostRepo->create($logAmbulanceCost);

        $createdlog_ambulance_cost = $createdlog_ambulance_cost->toArray();
        $this->assertArrayHasKey('id', $createdlog_ambulance_cost);
        $this->assertNotNull($createdlog_ambulance_cost['id'], 'Created log_ambulance_cost must have id specified');
        $this->assertNotNull(log_ambulance_cost::find($createdlog_ambulance_cost['id']), 'log_ambulance_cost with given id must be in DB');
        $this->assertModelData($logAmbulanceCost, $createdlog_ambulance_cost);
    }

    /**
     * @test read
     */
    public function test_read_log_ambulance_cost()
    {
        $logAmbulanceCost = log_ambulance_cost::factory()->create();

        $dblog_ambulance_cost = $this->logAmbulanceCostRepo->find($logAmbulanceCost->id);

        $dblog_ambulance_cost = $dblog_ambulance_cost->toArray();
        $this->assertModelData($logAmbulanceCost->toArray(), $dblog_ambulance_cost);
    }

    /**
     * @test update
     */
    public function test_update_log_ambulance_cost()
    {
        $logAmbulanceCost = log_ambulance_cost::factory()->create();
        $fakelog_ambulance_cost = log_ambulance_cost::factory()->make()->toArray();

        $updatedlog_ambulance_cost = $this->logAmbulanceCostRepo->update($fakelog_ambulance_cost, $logAmbulanceCost->id);

        $this->assertModelData($fakelog_ambulance_cost, $updatedlog_ambulance_cost->toArray());
        $dblog_ambulance_cost = $this->logAmbulanceCostRepo->find($logAmbulanceCost->id);
        $this->assertModelData($fakelog_ambulance_cost, $dblog_ambulance_cost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_ambulance_cost()
    {
        $logAmbulanceCost = log_ambulance_cost::factory()->create();

        $resp = $this->logAmbulanceCostRepo->delete($logAmbulanceCost->id);

        $this->assertTrue($resp);
        $this->assertNull(log_ambulance_cost::find($logAmbulanceCost->id), 'log_ambulance_cost should not exist in DB');
    }
}
