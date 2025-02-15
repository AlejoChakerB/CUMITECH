<?php namespace Tests\Repositories;

use App\Models\log_imaging_production_detail;
use App\Repositories\log_imaging_production_detailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_imaging_production_detailRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_imaging_production_detailRepository
     */
    protected $logImagingProductionDetailRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logImagingProductionDetailRepo = \App::make(log_imaging_production_detailRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_imaging_production_detail()
    {
        $logImagingProductionDetail = log_imaging_production_detail::factory()->make()->toArray();

        $createdlog_imaging_production_detail = $this->logImagingProductionDetailRepo->create($logImagingProductionDetail);

        $createdlog_imaging_production_detail = $createdlog_imaging_production_detail->toArray();
        $this->assertArrayHasKey('id', $createdlog_imaging_production_detail);
        $this->assertNotNull($createdlog_imaging_production_detail['id'], 'Created log_imaging_production_detail must have id specified');
        $this->assertNotNull(log_imaging_production_detail::find($createdlog_imaging_production_detail['id']), 'log_imaging_production_detail with given id must be in DB');
        $this->assertModelData($logImagingProductionDetail, $createdlog_imaging_production_detail);
    }

    /**
     * @test read
     */
    public function test_read_log_imaging_production_detail()
    {
        $logImagingProductionDetail = log_imaging_production_detail::factory()->create();

        $dblog_imaging_production_detail = $this->logImagingProductionDetailRepo->find($logImagingProductionDetail->id);

        $dblog_imaging_production_detail = $dblog_imaging_production_detail->toArray();
        $this->assertModelData($logImagingProductionDetail->toArray(), $dblog_imaging_production_detail);
    }

    /**
     * @test update
     */
    public function test_update_log_imaging_production_detail()
    {
        $logImagingProductionDetail = log_imaging_production_detail::factory()->create();
        $fakelog_imaging_production_detail = log_imaging_production_detail::factory()->make()->toArray();

        $updatedlog_imaging_production_detail = $this->logImagingProductionDetailRepo->update($fakelog_imaging_production_detail, $logImagingProductionDetail->id);

        $this->assertModelData($fakelog_imaging_production_detail, $updatedlog_imaging_production_detail->toArray());
        $dblog_imaging_production_detail = $this->logImagingProductionDetailRepo->find($logImagingProductionDetail->id);
        $this->assertModelData($fakelog_imaging_production_detail, $dblog_imaging_production_detail->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_imaging_production_detail()
    {
        $logImagingProductionDetail = log_imaging_production_detail::factory()->create();

        $resp = $this->logImagingProductionDetailRepo->delete($logImagingProductionDetail->id);

        $this->assertTrue($resp);
        $this->assertNull(log_imaging_production_detail::find($logImagingProductionDetail->id), 'log_imaging_production_detail should not exist in DB');
    }
}
