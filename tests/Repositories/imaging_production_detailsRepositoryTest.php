<?php namespace Tests\Repositories;

use App\Models\imaging_production_details;
use App\Repositories\imaging_production_detailsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class imaging_production_detailsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var imaging_production_detailsRepository
     */
    protected $imagingProductionDetailsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->imagingProductionDetailsRepo = \App::make(imaging_production_detailsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_imaging_production_details()
    {
        $imagingProductionDetails = imaging_production_details::factory()->make()->toArray();

        $createdimaging_production_details = $this->imagingProductionDetailsRepo->create($imagingProductionDetails);

        $createdimaging_production_details = $createdimaging_production_details->toArray();
        $this->assertArrayHasKey('id', $createdimaging_production_details);
        $this->assertNotNull($createdimaging_production_details['id'], 'Created imaging_production_details must have id specified');
        $this->assertNotNull(imaging_production_details::find($createdimaging_production_details['id']), 'imaging_production_details with given id must be in DB');
        $this->assertModelData($imagingProductionDetails, $createdimaging_production_details);
    }

    /**
     * @test read
     */
    public function test_read_imaging_production_details()
    {
        $imagingProductionDetails = imaging_production_details::factory()->create();

        $dbimaging_production_details = $this->imagingProductionDetailsRepo->find($imagingProductionDetails->id);

        $dbimaging_production_details = $dbimaging_production_details->toArray();
        $this->assertModelData($imagingProductionDetails->toArray(), $dbimaging_production_details);
    }

    /**
     * @test update
     */
    public function test_update_imaging_production_details()
    {
        $imagingProductionDetails = imaging_production_details::factory()->create();
        $fakeimaging_production_details = imaging_production_details::factory()->make()->toArray();

        $updatedimaging_production_details = $this->imagingProductionDetailsRepo->update($fakeimaging_production_details, $imagingProductionDetails->id);

        $this->assertModelData($fakeimaging_production_details, $updatedimaging_production_details->toArray());
        $dbimaging_production_details = $this->imagingProductionDetailsRepo->find($imagingProductionDetails->id);
        $this->assertModelData($fakeimaging_production_details, $dbimaging_production_details->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_imaging_production_details()
    {
        $imagingProductionDetails = imaging_production_details::factory()->create();

        $resp = $this->imagingProductionDetailsRepo->delete($imagingProductionDetails->id);

        $this->assertTrue($resp);
        $this->assertNull(imaging_production_details::find($imagingProductionDetails->id), 'imaging_production_details should not exist in DB');
    }
}
