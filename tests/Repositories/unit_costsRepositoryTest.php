<?php namespace Tests\Repositories;

use App\Models\unit_costs;
use App\Repositories\unit_costsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class unit_costsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var unit_costsRepository
     */
    protected $unitCostsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->unitCostsRepo = \App::make(unit_costsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_unit_costs()
    {
        $unitCosts = unit_costs::factory()->make()->toArray();

        $createdunit_costs = $this->unitCostsRepo->create($unitCosts);

        $createdunit_costs = $createdunit_costs->toArray();
        $this->assertArrayHasKey('id', $createdunit_costs);
        $this->assertNotNull($createdunit_costs['id'], 'Created unit_costs must have id specified');
        $this->assertNotNull(unit_costs::find($createdunit_costs['id']), 'unit_costs with given id must be in DB');
        $this->assertModelData($unitCosts, $createdunit_costs);
    }

    /**
     * @test read
     */
    public function test_read_unit_costs()
    {
        $unitCosts = unit_costs::factory()->create();

        $dbunit_costs = $this->unitCostsRepo->find($unitCosts->id);

        $dbunit_costs = $dbunit_costs->toArray();
        $this->assertModelData($unitCosts->toArray(), $dbunit_costs);
    }

    /**
     * @test update
     */
    public function test_update_unit_costs()
    {
        $unitCosts = unit_costs::factory()->create();
        $fakeunit_costs = unit_costs::factory()->make()->toArray();

        $updatedunit_costs = $this->unitCostsRepo->update($fakeunit_costs, $unitCosts->id);

        $this->assertModelData($fakeunit_costs, $updatedunit_costs->toArray());
        $dbunit_costs = $this->unitCostsRepo->find($unitCosts->id);
        $this->assertModelData($fakeunit_costs, $dbunit_costs->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_unit_costs()
    {
        $unitCosts = unit_costs::factory()->create();

        $resp = $this->unitCostsRepo->delete($unitCosts->id);

        $this->assertTrue($resp);
        $this->assertNull(unit_costs::find($unitCosts->id), 'unit_costs should not exist in DB');
    }
}
