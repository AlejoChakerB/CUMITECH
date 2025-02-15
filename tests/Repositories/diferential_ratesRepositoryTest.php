<?php namespace Tests\Repositories;

use App\Models\diferential_rates;
use App\Repositories\diferential_ratesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class diferential_ratesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var diferential_ratesRepository
     */
    protected $diferentialRatesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->diferentialRatesRepo = \App::make(diferential_ratesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_diferential_rates()
    {
        $diferentialRates = diferential_rates::factory()->make()->toArray();

        $createddiferential_rates = $this->diferentialRatesRepo->create($diferentialRates);

        $createddiferential_rates = $createddiferential_rates->toArray();
        $this->assertArrayHasKey('id', $createddiferential_rates);
        $this->assertNotNull($createddiferential_rates['id'], 'Created diferential_rates must have id specified');
        $this->assertNotNull(diferential_rates::find($createddiferential_rates['id']), 'diferential_rates with given id must be in DB');
        $this->assertModelData($diferentialRates, $createddiferential_rates);
    }

    /**
     * @test read
     */
    public function test_read_diferential_rates()
    {
        $diferentialRates = diferential_rates::factory()->create();

        $dbdiferential_rates = $this->diferentialRatesRepo->find($diferentialRates->id);

        $dbdiferential_rates = $dbdiferential_rates->toArray();
        $this->assertModelData($diferentialRates->toArray(), $dbdiferential_rates);
    }

    /**
     * @test update
     */
    public function test_update_diferential_rates()
    {
        $diferentialRates = diferential_rates::factory()->create();
        $fakediferential_rates = diferential_rates::factory()->make()->toArray();

        $updateddiferential_rates = $this->diferentialRatesRepo->update($fakediferential_rates, $diferentialRates->id);

        $this->assertModelData($fakediferential_rates, $updateddiferential_rates->toArray());
        $dbdiferential_rates = $this->diferentialRatesRepo->find($diferentialRates->id);
        $this->assertModelData($fakediferential_rates, $dbdiferential_rates->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_diferential_rates()
    {
        $diferentialRates = diferential_rates::factory()->create();

        $resp = $this->diferentialRatesRepo->delete($diferentialRates->id);

        $this->assertTrue($resp);
        $this->assertNull(diferential_rates::find($diferentialRates->id), 'diferential_rates should not exist in DB');
    }
}
