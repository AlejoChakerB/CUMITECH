<?php namespace Tests\Repositories;

use App\Models\imaging_production_cupsxitems;
use App\Repositories\imaging_production_cupsxitemsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class imaging_production_cupsxitemsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var imaging_production_cupsxitemsRepository
     */
    protected $imagingProductionCupsxitemsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->imagingProductionCupsxitemsRepo = \App::make(imaging_production_cupsxitemsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_imaging_production_cupsxitems()
    {
        $imagingProductionCupsxitems = imaging_production_cupsxitems::factory()->make()->toArray();

        $createdimaging_production_cupsxitems = $this->imagingProductionCupsxitemsRepo->create($imagingProductionCupsxitems);

        $createdimaging_production_cupsxitems = $createdimaging_production_cupsxitems->toArray();
        $this->assertArrayHasKey('id', $createdimaging_production_cupsxitems);
        $this->assertNotNull($createdimaging_production_cupsxitems['id'], 'Created imaging_production_cupsxitems must have id specified');
        $this->assertNotNull(imaging_production_cupsxitems::find($createdimaging_production_cupsxitems['id']), 'imaging_production_cupsxitems with given id must be in DB');
        $this->assertModelData($imagingProductionCupsxitems, $createdimaging_production_cupsxitems);
    }

    /**
     * @test read
     */
    public function test_read_imaging_production_cupsxitems()
    {
        $imagingProductionCupsxitems = imaging_production_cupsxitems::factory()->create();

        $dbimaging_production_cupsxitems = $this->imagingProductionCupsxitemsRepo->find($imagingProductionCupsxitems->id);

        $dbimaging_production_cupsxitems = $dbimaging_production_cupsxitems->toArray();
        $this->assertModelData($imagingProductionCupsxitems->toArray(), $dbimaging_production_cupsxitems);
    }

    /**
     * @test update
     */
    public function test_update_imaging_production_cupsxitems()
    {
        $imagingProductionCupsxitems = imaging_production_cupsxitems::factory()->create();
        $fakeimaging_production_cupsxitems = imaging_production_cupsxitems::factory()->make()->toArray();

        $updatedimaging_production_cupsxitems = $this->imagingProductionCupsxitemsRepo->update($fakeimaging_production_cupsxitems, $imagingProductionCupsxitems->id);

        $this->assertModelData($fakeimaging_production_cupsxitems, $updatedimaging_production_cupsxitems->toArray());
        $dbimaging_production_cupsxitems = $this->imagingProductionCupsxitemsRepo->find($imagingProductionCupsxitems->id);
        $this->assertModelData($fakeimaging_production_cupsxitems, $dbimaging_production_cupsxitems->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_imaging_production_cupsxitems()
    {
        $imagingProductionCupsxitems = imaging_production_cupsxitems::factory()->create();

        $resp = $this->imagingProductionCupsxitemsRepo->delete($imagingProductionCupsxitems->id);

        $this->assertTrue($resp);
        $this->assertNull(imaging_production_cupsxitems::find($imagingProductionCupsxitems->id), 'imaging_production_cupsxitems should not exist in DB');
    }
}
