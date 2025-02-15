<?php namespace Tests\Repositories;

use App\Models\surgery;
use App\Repositories\surgeryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class surgeryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var surgeryRepository
     */
    protected $surgeryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->surgeryRepo = \App::make(surgeryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_surgery()
    {
        $surgery = surgery::factory()->make()->toArray();

        $createdsurgery = $this->surgeryRepo->create($surgery);

        $createdsurgery = $createdsurgery->toArray();
        $this->assertArrayHasKey('id', $createdsurgery);
        $this->assertNotNull($createdsurgery['id'], 'Created surgery must have id specified');
        $this->assertNotNull(surgery::find($createdsurgery['id']), 'surgery with given id must be in DB');
        $this->assertModelData($surgery, $createdsurgery);
    }

    /**
     * @test read
     */
    public function test_read_surgery()
    {
        $surgery = surgery::factory()->create();

        $dbsurgery = $this->surgeryRepo->find($surgery->id);

        $dbsurgery = $dbsurgery->toArray();
        $this->assertModelData($surgery->toArray(), $dbsurgery);
    }

    /**
     * @test update
     */
    public function test_update_surgery()
    {
        $surgery = surgery::factory()->create();
        $fakesurgery = surgery::factory()->make()->toArray();

        $updatedsurgery = $this->surgeryRepo->update($fakesurgery, $surgery->id);

        $this->assertModelData($fakesurgery, $updatedsurgery->toArray());
        $dbsurgery = $this->surgeryRepo->find($surgery->id);
        $this->assertModelData($fakesurgery, $dbsurgery->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_surgery()
    {
        $surgery = surgery::factory()->create();

        $resp = $this->surgeryRepo->delete($surgery->id);

        $this->assertTrue($resp);
        $this->assertNull(surgery::find($surgery->id), 'surgery should not exist in DB');
    }
}
