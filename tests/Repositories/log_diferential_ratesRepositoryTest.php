<?php namespace Tests\Repositories;

use App\Models\log_diferential_rates;
use App\Repositories\log_diferential_ratesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_diferential_ratesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_diferential_ratesRepository
     */
    protected $logDiferentialRatesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logDiferentialRatesRepo = \App::make(log_diferential_ratesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_diferential_rates()
    {
        $logDiferentialRates = log_diferential_rates::factory()->make()->toArray();

        $createdlog_diferential_rates = $this->logDiferentialRatesRepo->create($logDiferentialRates);

        $createdlog_diferential_rates = $createdlog_diferential_rates->toArray();
        $this->assertArrayHasKey('id', $createdlog_diferential_rates);
        $this->assertNotNull($createdlog_diferential_rates['id'], 'Created log_diferential_rates must have id specified');
        $this->assertNotNull(log_diferential_rates::find($createdlog_diferential_rates['id']), 'log_diferential_rates with given id must be in DB');
        $this->assertModelData($logDiferentialRates, $createdlog_diferential_rates);
    }

    /**
     * @test read
     */
    public function test_read_log_diferential_rates()
    {
        $logDiferentialRates = log_diferential_rates::factory()->create();

        $dblog_diferential_rates = $this->logDiferentialRatesRepo->find($logDiferentialRates->id);

        $dblog_diferential_rates = $dblog_diferential_rates->toArray();
        $this->assertModelData($logDiferentialRates->toArray(), $dblog_diferential_rates);
    }

    /**
     * @test update
     */
    public function test_update_log_diferential_rates()
    {
        $logDiferentialRates = log_diferential_rates::factory()->create();
        $fakelog_diferential_rates = log_diferential_rates::factory()->make()->toArray();

        $updatedlog_diferential_rates = $this->logDiferentialRatesRepo->update($fakelog_diferential_rates, $logDiferentialRates->id);

        $this->assertModelData($fakelog_diferential_rates, $updatedlog_diferential_rates->toArray());
        $dblog_diferential_rates = $this->logDiferentialRatesRepo->find($logDiferentialRates->id);
        $this->assertModelData($fakelog_diferential_rates, $dblog_diferential_rates->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_diferential_rates()
    {
        $logDiferentialRates = log_diferential_rates::factory()->create();

        $resp = $this->logDiferentialRatesRepo->delete($logDiferentialRates->id);

        $this->assertTrue($resp);
        $this->assertNull(log_diferential_rates::find($logDiferentialRates->id), 'log_diferential_rates should not exist in DB');
    }
}
