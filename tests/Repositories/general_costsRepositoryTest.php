<?php namespace Tests\Repositories;

use App\Models\general_costs;
use App\Repositories\general_costsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class general_costsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var general_costsRepository
     */
    protected $generalCostsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->generalCostsRepo = \App::make(general_costsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_general_costs()
    {
        $generalCosts = general_costs::factory()->make()->toArray();

        $createdgeneral_costs = $this->generalCostsRepo->create($generalCosts);

        $createdgeneral_costs = $createdgeneral_costs->toArray();
        $this->assertArrayHasKey('id', $createdgeneral_costs);
        $this->assertNotNull($createdgeneral_costs['id'], 'Created general_costs must have id specified');
        $this->assertNotNull(general_costs::find($createdgeneral_costs['id']), 'general_costs with given id must be in DB');
        $this->assertModelData($generalCosts, $createdgeneral_costs);
    }

    /**
     * @test read
     */
    public function test_read_general_costs()
    {
        $generalCosts = general_costs::factory()->create();

        $dbgeneral_costs = $this->generalCostsRepo->find($generalCosts->id);

        $dbgeneral_costs = $dbgeneral_costs->toArray();
        $this->assertModelData($generalCosts->toArray(), $dbgeneral_costs);
    }

    /**
     * @test update
     */
    public function test_update_general_costs()
    {
        $generalCosts = general_costs::factory()->create();
        $fakegeneral_costs = general_costs::factory()->make()->toArray();

        $updatedgeneral_costs = $this->generalCostsRepo->update($fakegeneral_costs, $generalCosts->id);

        $this->assertModelData($fakegeneral_costs, $updatedgeneral_costs->toArray());
        $dbgeneral_costs = $this->generalCostsRepo->find($generalCosts->id);
        $this->assertModelData($fakegeneral_costs, $dbgeneral_costs->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_general_costs()
    {
        $generalCosts = general_costs::factory()->create();

        $resp = $this->generalCostsRepo->delete($generalCosts->id);

        $this->assertTrue($resp);
        $this->assertNull(general_costs::find($generalCosts->id), 'general_costs should not exist in DB');
    }
}
