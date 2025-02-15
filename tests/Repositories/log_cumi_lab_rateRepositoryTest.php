<?php namespace Tests\Repositories;

use App\Models\log_cumi_lab_rate;
use App\Repositories\log_cumi_lab_rateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_cumi_lab_rateRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_cumi_lab_rateRepository
     */
    protected $logCumiLabRateRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logCumiLabRateRepo = \App::make(log_cumi_lab_rateRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_cumi_lab_rate()
    {
        $logCumiLabRate = log_cumi_lab_rate::factory()->make()->toArray();

        $createdlog_cumi_lab_rate = $this->logCumiLabRateRepo->create($logCumiLabRate);

        $createdlog_cumi_lab_rate = $createdlog_cumi_lab_rate->toArray();
        $this->assertArrayHasKey('id', $createdlog_cumi_lab_rate);
        $this->assertNotNull($createdlog_cumi_lab_rate['id'], 'Created log_cumi_lab_rate must have id specified');
        $this->assertNotNull(log_cumi_lab_rate::find($createdlog_cumi_lab_rate['id']), 'log_cumi_lab_rate with given id must be in DB');
        $this->assertModelData($logCumiLabRate, $createdlog_cumi_lab_rate);
    }

    /**
     * @test read
     */
    public function test_read_log_cumi_lab_rate()
    {
        $logCumiLabRate = log_cumi_lab_rate::factory()->create();

        $dblog_cumi_lab_rate = $this->logCumiLabRateRepo->find($logCumiLabRate->id);

        $dblog_cumi_lab_rate = $dblog_cumi_lab_rate->toArray();
        $this->assertModelData($logCumiLabRate->toArray(), $dblog_cumi_lab_rate);
    }

    /**
     * @test update
     */
    public function test_update_log_cumi_lab_rate()
    {
        $logCumiLabRate = log_cumi_lab_rate::factory()->create();
        $fakelog_cumi_lab_rate = log_cumi_lab_rate::factory()->make()->toArray();

        $updatedlog_cumi_lab_rate = $this->logCumiLabRateRepo->update($fakelog_cumi_lab_rate, $logCumiLabRate->id);

        $this->assertModelData($fakelog_cumi_lab_rate, $updatedlog_cumi_lab_rate->toArray());
        $dblog_cumi_lab_rate = $this->logCumiLabRateRepo->find($logCumiLabRate->id);
        $this->assertModelData($fakelog_cumi_lab_rate, $dblog_cumi_lab_rate->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_cumi_lab_rate()
    {
        $logCumiLabRate = log_cumi_lab_rate::factory()->create();

        $resp = $this->logCumiLabRateRepo->delete($logCumiLabRate->id);

        $this->assertTrue($resp);
        $this->assertNull(log_cumi_lab_rate::find($logCumiLabRate->id), 'log_cumi_lab_rate should not exist in DB');
    }
}
