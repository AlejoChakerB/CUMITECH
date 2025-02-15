<?php namespace Tests\Repositories;

use App\Models\procedures_homologator;
use App\Repositories\procedures_homologatorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class procedures_homologatorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var procedures_homologatorRepository
     */
    protected $proceduresHomologatorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->proceduresHomologatorRepo = \App::make(procedures_homologatorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_procedures_homologator()
    {
        $proceduresHomologator = procedures_homologator::factory()->make()->toArray();

        $createdprocedures_homologator = $this->proceduresHomologatorRepo->create($proceduresHomologator);

        $createdprocedures_homologator = $createdprocedures_homologator->toArray();
        $this->assertArrayHasKey('id', $createdprocedures_homologator);
        $this->assertNotNull($createdprocedures_homologator['id'], 'Created procedures_homologator must have id specified');
        $this->assertNotNull(procedures_homologator::find($createdprocedures_homologator['id']), 'procedures_homologator with given id must be in DB');
        $this->assertModelData($proceduresHomologator, $createdprocedures_homologator);
    }

    /**
     * @test read
     */
    public function test_read_procedures_homologator()
    {
        $proceduresHomologator = procedures_homologator::factory()->create();

        $dbprocedures_homologator = $this->proceduresHomologatorRepo->find($proceduresHomologator->id);

        $dbprocedures_homologator = $dbprocedures_homologator->toArray();
        $this->assertModelData($proceduresHomologator->toArray(), $dbprocedures_homologator);
    }

    /**
     * @test update
     */
    public function test_update_procedures_homologator()
    {
        $proceduresHomologator = procedures_homologator::factory()->create();
        $fakeprocedures_homologator = procedures_homologator::factory()->make()->toArray();

        $updatedprocedures_homologator = $this->proceduresHomologatorRepo->update($fakeprocedures_homologator, $proceduresHomologator->id);

        $this->assertModelData($fakeprocedures_homologator, $updatedprocedures_homologator->toArray());
        $dbprocedures_homologator = $this->proceduresHomologatorRepo->find($proceduresHomologator->id);
        $this->assertModelData($fakeprocedures_homologator, $dbprocedures_homologator->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_procedures_homologator()
    {
        $proceduresHomologator = procedures_homologator::factory()->create();

        $resp = $this->proceduresHomologatorRepo->delete($proceduresHomologator->id);

        $this->assertTrue($resp);
        $this->assertNull(procedures_homologator::find($proceduresHomologator->id), 'procedures_homologator should not exist in DB');
    }
}
