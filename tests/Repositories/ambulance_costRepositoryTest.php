<?php namespace Tests\Repositories;

use App\Models\ambulance_cost;
use App\Repositories\ambulance_costRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ambulance_costRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ambulance_costRepository
     */
    protected $ambulanceCostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ambulanceCostRepo = \App::make(ambulance_costRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ambulance_cost()
    {
        $ambulanceCost = ambulance_cost::factory()->make()->toArray();

        $createdambulance_cost = $this->ambulanceCostRepo->create($ambulanceCost);

        $createdambulance_cost = $createdambulance_cost->toArray();
        $this->assertArrayHasKey('id', $createdambulance_cost);
        $this->assertNotNull($createdambulance_cost['id'], 'Created ambulance_cost must have id specified');
        $this->assertNotNull(ambulance_cost::find($createdambulance_cost['id']), 'ambulance_cost with given id must be in DB');
        $this->assertModelData($ambulanceCost, $createdambulance_cost);
    }

    /**
     * @test read
     */
    public function test_read_ambulance_cost()
    {
        $ambulanceCost = ambulance_cost::factory()->create();

        $dbambulance_cost = $this->ambulanceCostRepo->find($ambulanceCost->id);

        $dbambulance_cost = $dbambulance_cost->toArray();
        $this->assertModelData($ambulanceCost->toArray(), $dbambulance_cost);
    }

    /**
     * @test update
     */
    public function test_update_ambulance_cost()
    {
        $ambulanceCost = ambulance_cost::factory()->create();
        $fakeambulance_cost = ambulance_cost::factory()->make()->toArray();

        $updatedambulance_cost = $this->ambulanceCostRepo->update($fakeambulance_cost, $ambulanceCost->id);

        $this->assertModelData($fakeambulance_cost, $updatedambulance_cost->toArray());
        $dbambulance_cost = $this->ambulanceCostRepo->find($ambulanceCost->id);
        $this->assertModelData($fakeambulance_cost, $dbambulance_cost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ambulance_cost()
    {
        $ambulanceCost = ambulance_cost::factory()->create();

        $resp = $this->ambulanceCostRepo->delete($ambulanceCost->id);

        $this->assertTrue($resp);
        $this->assertNull(ambulance_cost::find($ambulanceCost->id), 'ambulance_cost should not exist in DB');
    }
}
