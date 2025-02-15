<?php namespace Tests\Repositories;

use App\Models\log_accommodation_cost;
use App\Repositories\log_accommodation_costRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_accommodation_costRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_accommodation_costRepository
     */
    protected $logAccommodationCostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logAccommodationCostRepo = \App::make(log_accommodation_costRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_accommodation_cost()
    {
        $logAccommodationCost = log_accommodation_cost::factory()->make()->toArray();

        $createdlog_accommodation_cost = $this->logAccommodationCostRepo->create($logAccommodationCost);

        $createdlog_accommodation_cost = $createdlog_accommodation_cost->toArray();
        $this->assertArrayHasKey('id', $createdlog_accommodation_cost);
        $this->assertNotNull($createdlog_accommodation_cost['id'], 'Created log_accommodation_cost must have id specified');
        $this->assertNotNull(log_accommodation_cost::find($createdlog_accommodation_cost['id']), 'log_accommodation_cost with given id must be in DB');
        $this->assertModelData($logAccommodationCost, $createdlog_accommodation_cost);
    }

    /**
     * @test read
     */
    public function test_read_log_accommodation_cost()
    {
        $logAccommodationCost = log_accommodation_cost::factory()->create();

        $dblog_accommodation_cost = $this->logAccommodationCostRepo->find($logAccommodationCost->id);

        $dblog_accommodation_cost = $dblog_accommodation_cost->toArray();
        $this->assertModelData($logAccommodationCost->toArray(), $dblog_accommodation_cost);
    }

    /**
     * @test update
     */
    public function test_update_log_accommodation_cost()
    {
        $logAccommodationCost = log_accommodation_cost::factory()->create();
        $fakelog_accommodation_cost = log_accommodation_cost::factory()->make()->toArray();

        $updatedlog_accommodation_cost = $this->logAccommodationCostRepo->update($fakelog_accommodation_cost, $logAccommodationCost->id);

        $this->assertModelData($fakelog_accommodation_cost, $updatedlog_accommodation_cost->toArray());
        $dblog_accommodation_cost = $this->logAccommodationCostRepo->find($logAccommodationCost->id);
        $this->assertModelData($fakelog_accommodation_cost, $dblog_accommodation_cost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_accommodation_cost()
    {
        $logAccommodationCost = log_accommodation_cost::factory()->create();

        $resp = $this->logAccommodationCostRepo->delete($logAccommodationCost->id);

        $this->assertTrue($resp);
        $this->assertNull(log_accommodation_cost::find($logAccommodationCost->id), 'log_accommodation_cost should not exist in DB');
    }
}
