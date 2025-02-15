<?php namespace Tests\Repositories;

use App\Models\endowment;
use App\Repositories\endowmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class endowmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var endowmentRepository
     */
    protected $endowmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->endowmentRepo = \App::make(endowmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_endowment()
    {
        $endowment = endowment::factory()->make()->toArray();

        $createdendowment = $this->endowmentRepo->create($endowment);

        $createdendowment = $createdendowment->toArray();
        $this->assertArrayHasKey('id', $createdendowment);
        $this->assertNotNull($createdendowment['id'], 'Created endowment must have id specified');
        $this->assertNotNull(endowment::find($createdendowment['id']), 'endowment with given id must be in DB');
        $this->assertModelData($endowment, $createdendowment);
    }

    /**
     * @test read
     */
    public function test_read_endowment()
    {
        $endowment = endowment::factory()->create();

        $dbendowment = $this->endowmentRepo->find($endowment->id);

        $dbendowment = $dbendowment->toArray();
        $this->assertModelData($endowment->toArray(), $dbendowment);
    }

    /**
     * @test update
     */
    public function test_update_endowment()
    {
        $endowment = endowment::factory()->create();
        $fakeendowment = endowment::factory()->make()->toArray();

        $updatedendowment = $this->endowmentRepo->update($fakeendowment, $endowment->id);

        $this->assertModelData($fakeendowment, $updatedendowment->toArray());
        $dbendowment = $this->endowmentRepo->find($endowment->id);
        $this->assertModelData($fakeendowment, $dbendowment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_endowment()
    {
        $endowment = endowment::factory()->create();

        $resp = $this->endowmentRepo->delete($endowment->id);

        $this->assertTrue($resp);
        $this->assertNull(endowment::find($endowment->id), 'endowment should not exist in DB');
    }
}
