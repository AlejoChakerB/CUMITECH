<?php namespace Tests\Repositories;

use App\Models\imaging_production_month;
use App\Repositories\imaging_production_monthRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class imaging_production_monthRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var imaging_production_monthRepository
     */
    protected $imagingProductionMonthRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->imagingProductionMonthRepo = \App::make(imaging_production_monthRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_imaging_production_month()
    {
        $imagingProductionMonth = imaging_production_month::factory()->make()->toArray();

        $createdimaging_production_month = $this->imagingProductionMonthRepo->create($imagingProductionMonth);

        $createdimaging_production_month = $createdimaging_production_month->toArray();
        $this->assertArrayHasKey('id', $createdimaging_production_month);
        $this->assertNotNull($createdimaging_production_month['id'], 'Created imaging_production_month must have id specified');
        $this->assertNotNull(imaging_production_month::find($createdimaging_production_month['id']), 'imaging_production_month with given id must be in DB');
        $this->assertModelData($imagingProductionMonth, $createdimaging_production_month);
    }

    /**
     * @test read
     */
    public function test_read_imaging_production_month()
    {
        $imagingProductionMonth = imaging_production_month::factory()->create();

        $dbimaging_production_month = $this->imagingProductionMonthRepo->find($imagingProductionMonth->id);

        $dbimaging_production_month = $dbimaging_production_month->toArray();
        $this->assertModelData($imagingProductionMonth->toArray(), $dbimaging_production_month);
    }

    /**
     * @test update
     */
    public function test_update_imaging_production_month()
    {
        $imagingProductionMonth = imaging_production_month::factory()->create();
        $fakeimaging_production_month = imaging_production_month::factory()->make()->toArray();

        $updatedimaging_production_month = $this->imagingProductionMonthRepo->update($fakeimaging_production_month, $imagingProductionMonth->id);

        $this->assertModelData($fakeimaging_production_month, $updatedimaging_production_month->toArray());
        $dbimaging_production_month = $this->imagingProductionMonthRepo->find($imagingProductionMonth->id);
        $this->assertModelData($fakeimaging_production_month, $dbimaging_production_month->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_imaging_production_month()
    {
        $imagingProductionMonth = imaging_production_month::factory()->create();

        $resp = $this->imagingProductionMonthRepo->delete($imagingProductionMonth->id);

        $this->assertTrue($resp);
        $this->assertNull(imaging_production_month::find($imagingProductionMonth->id), 'imaging_production_month should not exist in DB');
    }
}
