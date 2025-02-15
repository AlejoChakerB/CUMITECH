<?php namespace Tests\Repositories;

use App\Models\contracts;
use App\Repositories\contractsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class contractsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var contractsRepository
     */
    protected $contractsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contractsRepo = \App::make(contractsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contracts()
    {
        $contracts = contracts::factory()->make()->toArray();

        $createdcontracts = $this->contractsRepo->create($contracts);

        $createdcontracts = $createdcontracts->toArray();
        $this->assertArrayHasKey('id', $createdcontracts);
        $this->assertNotNull($createdcontracts['id'], 'Created contracts must have id specified');
        $this->assertNotNull(contracts::find($createdcontracts['id']), 'contracts with given id must be in DB');
        $this->assertModelData($contracts, $createdcontracts);
    }

    /**
     * @test read
     */
    public function test_read_contracts()
    {
        $contracts = contracts::factory()->create();

        $dbcontracts = $this->contractsRepo->find($contracts->id);

        $dbcontracts = $dbcontracts->toArray();
        $this->assertModelData($contracts->toArray(), $dbcontracts);
    }

    /**
     * @test update
     */
    public function test_update_contracts()
    {
        $contracts = contracts::factory()->create();
        $fakecontracts = contracts::factory()->make()->toArray();

        $updatedcontracts = $this->contractsRepo->update($fakecontracts, $contracts->id);

        $this->assertModelData($fakecontracts, $updatedcontracts->toArray());
        $dbcontracts = $this->contractsRepo->find($contracts->id);
        $this->assertModelData($fakecontracts, $dbcontracts->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_contracts()
    {
        $contracts = contracts::factory()->create();

        $resp = $this->contractsRepo->delete($contracts->id);

        $this->assertTrue($resp);
        $this->assertNull(contracts::find($contracts->id), 'contracts should not exist in DB');
    }
}
