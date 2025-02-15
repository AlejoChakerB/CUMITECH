<?php namespace Tests\Repositories;

use App\Models\multiple_surgery;
use App\Repositories\multiple_surgeryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class multiple_surgeryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var multiple_surgeryRepository
     */
    protected $multipleSurgeryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->multipleSurgeryRepo = \App::make(multiple_surgeryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_multiple_surgery()
    {
        $multipleSurgery = multiple_surgery::factory()->make()->toArray();

        $createdmultiple_surgery = $this->multipleSurgeryRepo->create($multipleSurgery);

        $createdmultiple_surgery = $createdmultiple_surgery->toArray();
        $this->assertArrayHasKey('id', $createdmultiple_surgery);
        $this->assertNotNull($createdmultiple_surgery['id'], 'Created multiple_surgery must have id specified');
        $this->assertNotNull(multiple_surgery::find($createdmultiple_surgery['id']), 'multiple_surgery with given id must be in DB');
        $this->assertModelData($multipleSurgery, $createdmultiple_surgery);
    }

    /**
     * @test read
     */
    public function test_read_multiple_surgery()
    {
        $multipleSurgery = multiple_surgery::factory()->create();

        $dbmultiple_surgery = $this->multipleSurgeryRepo->find($multipleSurgery->id);

        $dbmultiple_surgery = $dbmultiple_surgery->toArray();
        $this->assertModelData($multipleSurgery->toArray(), $dbmultiple_surgery);
    }

    /**
     * @test update
     */
    public function test_update_multiple_surgery()
    {
        $multipleSurgery = multiple_surgery::factory()->create();
        $fakemultiple_surgery = multiple_surgery::factory()->make()->toArray();

        $updatedmultiple_surgery = $this->multipleSurgeryRepo->update($fakemultiple_surgery, $multipleSurgery->id);

        $this->assertModelData($fakemultiple_surgery, $updatedmultiple_surgery->toArray());
        $dbmultiple_surgery = $this->multipleSurgeryRepo->find($multipleSurgery->id);
        $this->assertModelData($fakemultiple_surgery, $dbmultiple_surgery->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_multiple_surgery()
    {
        $multipleSurgery = multiple_surgery::factory()->create();

        $resp = $this->multipleSurgeryRepo->delete($multipleSurgery->id);

        $this->assertTrue($resp);
        $this->assertNull(multiple_surgery::find($multipleSurgery->id), 'multiple_surgery should not exist in DB');
    }
}
