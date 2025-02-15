<?php namespace Tests\Repositories;

use App\Models\procedures;
use App\Repositories\proceduresRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class proceduresRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var proceduresRepository
     */
    protected $proceduresRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->proceduresRepo = \App::make(proceduresRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_procedures()
    {
        $procedures = procedures::factory()->make()->toArray();

        $createdprocedures = $this->proceduresRepo->create($procedures);

        $createdprocedures = $createdprocedures->toArray();
        $this->assertArrayHasKey('id', $createdprocedures);
        $this->assertNotNull($createdprocedures['id'], 'Created procedures must have id specified');
        $this->assertNotNull(procedures::find($createdprocedures['id']), 'procedures with given id must be in DB');
        $this->assertModelData($procedures, $createdprocedures);
    }

    /**
     * @test read
     */
    public function test_read_procedures()
    {
        $procedures = procedures::factory()->create();

        $dbprocedures = $this->proceduresRepo->find($procedures->id);

        $dbprocedures = $dbprocedures->toArray();
        $this->assertModelData($procedures->toArray(), $dbprocedures);
    }

    /**
     * @test update
     */
    public function test_update_procedures()
    {
        $procedures = procedures::factory()->create();
        $fakeprocedures = procedures::factory()->make()->toArray();

        $updatedprocedures = $this->proceduresRepo->update($fakeprocedures, $procedures->id);

        $this->assertModelData($fakeprocedures, $updatedprocedures->toArray());
        $dbprocedures = $this->proceduresRepo->find($procedures->id);
        $this->assertModelData($fakeprocedures, $dbprocedures->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_procedures()
    {
        $procedures = procedures::factory()->create();

        $resp = $this->proceduresRepo->delete($procedures->id);

        $this->assertTrue($resp);
        $this->assertNull(procedures::find($procedures->id), 'procedures should not exist in DB');
    }
}
