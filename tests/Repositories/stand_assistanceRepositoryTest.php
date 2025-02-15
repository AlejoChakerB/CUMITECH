<?php namespace Tests\Repositories;

use App\Models\stand_assistance;
use App\Repositories\stand_assistanceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class stand_assistanceRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var stand_assistanceRepository
     */
    protected $standAssistanceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->standAssistanceRepo = \App::make(stand_assistanceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stand_assistance()
    {
        $standAssistance = stand_assistance::factory()->make()->toArray();

        $createdstand_assistance = $this->standAssistanceRepo->create($standAssistance);

        $createdstand_assistance = $createdstand_assistance->toArray();
        $this->assertArrayHasKey('id', $createdstand_assistance);
        $this->assertNotNull($createdstand_assistance['id'], 'Created stand_assistance must have id specified');
        $this->assertNotNull(stand_assistance::find($createdstand_assistance['id']), 'stand_assistance with given id must be in DB');
        $this->assertModelData($standAssistance, $createdstand_assistance);
    }

    /**
     * @test read
     */
    public function test_read_stand_assistance()
    {
        $standAssistance = stand_assistance::factory()->create();

        $dbstand_assistance = $this->standAssistanceRepo->find($standAssistance->id);

        $dbstand_assistance = $dbstand_assistance->toArray();
        $this->assertModelData($standAssistance->toArray(), $dbstand_assistance);
    }

    /**
     * @test update
     */
    public function test_update_stand_assistance()
    {
        $standAssistance = stand_assistance::factory()->create();
        $fakestand_assistance = stand_assistance::factory()->make()->toArray();

        $updatedstand_assistance = $this->standAssistanceRepo->update($fakestand_assistance, $standAssistance->id);

        $this->assertModelData($fakestand_assistance, $updatedstand_assistance->toArray());
        $dbstand_assistance = $this->standAssistanceRepo->find($standAssistance->id);
        $this->assertModelData($fakestand_assistance, $dbstand_assistance->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stand_assistance()
    {
        $standAssistance = stand_assistance::factory()->create();

        $resp = $this->standAssistanceRepo->delete($standAssistance->id);

        $this->assertTrue($resp);
        $this->assertNull(stand_assistance::find($standAssistance->id), 'stand_assistance should not exist in DB');
    }
}
