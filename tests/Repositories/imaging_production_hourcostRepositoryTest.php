<?php namespace Tests\Repositories;

use App\Models\imaging_production_hourcost;
use App\Repositories\imaging_production_hourcostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class imaging_production_hourcostRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var imaging_production_hourcostRepository
     */
    protected $imagingProductionHourcostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->imagingProductionHourcostRepo = \App::make(imaging_production_hourcostRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_imaging_production_hourcost()
    {
        $imagingProductionHourcost = imaging_production_hourcost::factory()->make()->toArray();

        $createdimaging_production_hourcost = $this->imagingProductionHourcostRepo->create($imagingProductionHourcost);

        $createdimaging_production_hourcost = $createdimaging_production_hourcost->toArray();
        $this->assertArrayHasKey('id', $createdimaging_production_hourcost);
        $this->assertNotNull($createdimaging_production_hourcost['id'], 'Created imaging_production_hourcost must have id specified');
        $this->assertNotNull(imaging_production_hourcost::find($createdimaging_production_hourcost['id']), 'imaging_production_hourcost with given id must be in DB');
        $this->assertModelData($imagingProductionHourcost, $createdimaging_production_hourcost);
    }

    /**
     * @test read
     */
    public function test_read_imaging_production_hourcost()
    {
        $imagingProductionHourcost = imaging_production_hourcost::factory()->create();

        $dbimaging_production_hourcost = $this->imagingProductionHourcostRepo->find($imagingProductionHourcost->id);

        $dbimaging_production_hourcost = $dbimaging_production_hourcost->toArray();
        $this->assertModelData($imagingProductionHourcost->toArray(), $dbimaging_production_hourcost);
    }

    /**
     * @test update
     */
    public function test_update_imaging_production_hourcost()
    {
        $imagingProductionHourcost = imaging_production_hourcost::factory()->create();
        $fakeimaging_production_hourcost = imaging_production_hourcost::factory()->make()->toArray();

        $updatedimaging_production_hourcost = $this->imagingProductionHourcostRepo->update($fakeimaging_production_hourcost, $imagingProductionHourcost->id);

        $this->assertModelData($fakeimaging_production_hourcost, $updatedimaging_production_hourcost->toArray());
        $dbimaging_production_hourcost = $this->imagingProductionHourcostRepo->find($imagingProductionHourcost->id);
        $this->assertModelData($fakeimaging_production_hourcost, $dbimaging_production_hourcost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_imaging_production_hourcost()
    {
        $imagingProductionHourcost = imaging_production_hourcost::factory()->create();

        $resp = $this->imagingProductionHourcostRepo->delete($imagingProductionHourcost->id);

        $this->assertTrue($resp);
        $this->assertNull(imaging_production_hourcost::find($imagingProductionHourcost->id), 'imaging_production_hourcost should not exist in DB');
    }
}
