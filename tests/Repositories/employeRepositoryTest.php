<?php namespace Tests\Repositories;

use App\Models\employe;
use App\Repositories\employeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class employeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var employeRepository
     */
    protected $employeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->employeRepo = \App::make(employeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_employe()
    {
        $employe = employe::factory()->make()->toArray();

        $createdemploye = $this->employeRepo->create($employe);

        $createdemploye = $createdemploye->toArray();
        $this->assertArrayHasKey('id', $createdemploye);
        $this->assertNotNull($createdemploye['id'], 'Created employe must have id specified');
        $this->assertNotNull(employe::find($createdemploye['id']), 'employe with given id must be in DB');
        $this->assertModelData($employe, $createdemploye);
    }

    /**
     * @test read
     */
    public function test_read_employe()
    {
        $employe = employe::factory()->create();

        $dbemploye = $this->employeRepo->find($employe->id);

        $dbemploye = $dbemploye->toArray();
        $this->assertModelData($employe->toArray(), $dbemploye);
    }

    /**
     * @test update
     */
    public function test_update_employe()
    {
        $employe = employe::factory()->create();
        $fakeemploye = employe::factory()->make()->toArray();

        $updatedemploye = $this->employeRepo->update($fakeemploye, $employe->id);

        $this->assertModelData($fakeemploye, $updatedemploye->toArray());
        $dbemploye = $this->employeRepo->find($employe->id);
        $this->assertModelData($fakeemploye, $dbemploye->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_employe()
    {
        $employe = employe::factory()->create();

        $resp = $this->employeRepo->delete($employe->id);

        $this->assertTrue($resp);
        $this->assertNull(employe::find($employe->id), 'employe should not exist in DB');
    }
}
