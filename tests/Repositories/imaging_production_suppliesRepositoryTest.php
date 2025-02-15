<?php namespace Tests\Repositories;

use App\Models\imaging_production_supplies;
use App\Repositories\imaging_production_suppliesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class imaging_production_suppliesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var imaging_production_suppliesRepository
     */
    protected $imagingProductionSuppliesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->imagingProductionSuppliesRepo = \App::make(imaging_production_suppliesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_imaging_production_supplies()
    {
        $imagingProductionSupplies = imaging_production_supplies::factory()->make()->toArray();

        $createdimaging_production_supplies = $this->imagingProductionSuppliesRepo->create($imagingProductionSupplies);

        $createdimaging_production_supplies = $createdimaging_production_supplies->toArray();
        $this->assertArrayHasKey('id', $createdimaging_production_supplies);
        $this->assertNotNull($createdimaging_production_supplies['id'], 'Created imaging_production_supplies must have id specified');
        $this->assertNotNull(imaging_production_supplies::find($createdimaging_production_supplies['id']), 'imaging_production_supplies with given id must be in DB');
        $this->assertModelData($imagingProductionSupplies, $createdimaging_production_supplies);
    }

    /**
     * @test read
     */
    public function test_read_imaging_production_supplies()
    {
        $imagingProductionSupplies = imaging_production_supplies::factory()->create();

        $dbimaging_production_supplies = $this->imagingProductionSuppliesRepo->find($imagingProductionSupplies->id);

        $dbimaging_production_supplies = $dbimaging_production_supplies->toArray();
        $this->assertModelData($imagingProductionSupplies->toArray(), $dbimaging_production_supplies);
    }

    /**
     * @test update
     */
    public function test_update_imaging_production_supplies()
    {
        $imagingProductionSupplies = imaging_production_supplies::factory()->create();
        $fakeimaging_production_supplies = imaging_production_supplies::factory()->make()->toArray();

        $updatedimaging_production_supplies = $this->imagingProductionSuppliesRepo->update($fakeimaging_production_supplies, $imagingProductionSupplies->id);

        $this->assertModelData($fakeimaging_production_supplies, $updatedimaging_production_supplies->toArray());
        $dbimaging_production_supplies = $this->imagingProductionSuppliesRepo->find($imagingProductionSupplies->id);
        $this->assertModelData($fakeimaging_production_supplies, $dbimaging_production_supplies->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_imaging_production_supplies()
    {
        $imagingProductionSupplies = imaging_production_supplies::factory()->create();

        $resp = $this->imagingProductionSuppliesRepo->delete($imagingProductionSupplies->id);

        $this->assertTrue($resp);
        $this->assertNull(imaging_production_supplies::find($imagingProductionSupplies->id), 'imaging_production_supplies should not exist in DB');
    }
}
