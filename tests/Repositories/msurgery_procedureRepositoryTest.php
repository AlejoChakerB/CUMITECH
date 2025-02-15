<?php namespace Tests\Repositories;

use App\Models\msurgery_procedure;
use App\Repositories\msurgery_procedureRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class msurgery_procedureRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var msurgery_procedureRepository
     */
    protected $msurgeryProcedureRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->msurgeryProcedureRepo = \App::make(msurgery_procedureRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_msurgery_procedure()
    {
        $msurgeryProcedure = msurgery_procedure::factory()->make()->toArray();

        $createdmsurgery_procedure = $this->msurgeryProcedureRepo->create($msurgeryProcedure);

        $createdmsurgery_procedure = $createdmsurgery_procedure->toArray();
        $this->assertArrayHasKey('id', $createdmsurgery_procedure);
        $this->assertNotNull($createdmsurgery_procedure['id'], 'Created msurgery_procedure must have id specified');
        $this->assertNotNull(msurgery_procedure::find($createdmsurgery_procedure['id']), 'msurgery_procedure with given id must be in DB');
        $this->assertModelData($msurgeryProcedure, $createdmsurgery_procedure);
    }

    /**
     * @test read
     */
    public function test_read_msurgery_procedure()
    {
        $msurgeryProcedure = msurgery_procedure::factory()->create();

        $dbmsurgery_procedure = $this->msurgeryProcedureRepo->find($msurgeryProcedure->id);

        $dbmsurgery_procedure = $dbmsurgery_procedure->toArray();
        $this->assertModelData($msurgeryProcedure->toArray(), $dbmsurgery_procedure);
    }

    /**
     * @test update
     */
    public function test_update_msurgery_procedure()
    {
        $msurgeryProcedure = msurgery_procedure::factory()->create();
        $fakemsurgery_procedure = msurgery_procedure::factory()->make()->toArray();

        $updatedmsurgery_procedure = $this->msurgeryProcedureRepo->update($fakemsurgery_procedure, $msurgeryProcedure->id);

        $this->assertModelData($fakemsurgery_procedure, $updatedmsurgery_procedure->toArray());
        $dbmsurgery_procedure = $this->msurgeryProcedureRepo->find($msurgeryProcedure->id);
        $this->assertModelData($fakemsurgery_procedure, $dbmsurgery_procedure->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_msurgery_procedure()
    {
        $msurgeryProcedure = msurgery_procedure::factory()->create();

        $resp = $this->msurgeryProcedureRepo->delete($msurgeryProcedure->id);

        $this->assertTrue($resp);
        $this->assertNull(msurgery_procedure::find($msurgeryProcedure->id), 'msurgery_procedure should not exist in DB');
    }
}
