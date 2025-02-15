<?php namespace Tests\Repositories;

use App\Models\imaging_production;
use App\Repositories\imaging_productionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class imaging_productionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var imaging_productionRepository
     */
    protected $imagingProductionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->imagingProductionRepo = \App::make(imaging_productionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_imaging_production()
    {
        $imagingProduction = imaging_production::factory()->make()->toArray();

        $createdimaging_production = $this->imagingProductionRepo->create($imagingProduction);

        $createdimaging_production = $createdimaging_production->toArray();
        $this->assertArrayHasKey('id', $createdimaging_production);
        $this->assertNotNull($createdimaging_production['id'], 'Created imaging_production must have id specified');
        $this->assertNotNull(imaging_production::find($createdimaging_production['id']), 'imaging_production with given id must be in DB');
        $this->assertModelData($imagingProduction, $createdimaging_production);
    }

    /**
     * @test read
     */
    public function test_read_imaging_production()
    {
        $imagingProduction = imaging_production::factory()->create();

        $dbimaging_production = $this->imagingProductionRepo->find($imagingProduction->id);

        $dbimaging_production = $dbimaging_production->toArray();
        $this->assertModelData($imagingProduction->toArray(), $dbimaging_production);
    }

    /**
     * @test update
     */
    public function test_update_imaging_production()
    {
        $imagingProduction = imaging_production::factory()->create();
        $fakeimaging_production = imaging_production::factory()->make()->toArray();

        $updatedimaging_production = $this->imagingProductionRepo->update($fakeimaging_production, $imagingProduction->id);

        $this->assertModelData($fakeimaging_production, $updatedimaging_production->toArray());
        $dbimaging_production = $this->imagingProductionRepo->find($imagingProduction->id);
        $this->assertModelData($fakeimaging_production, $dbimaging_production->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_imaging_production()
    {
        $imagingProduction = imaging_production::factory()->create();

        $resp = $this->imagingProductionRepo->delete($imagingProduction->id);

        $this->assertTrue($resp);
        $this->assertNull(imaging_production::find($imagingProduction->id), 'imaging_production should not exist in DB');
    }
}
