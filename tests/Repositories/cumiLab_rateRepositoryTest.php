<?php namespace Tests\Repositories;

use App\Models\cumiLab_rate;
use App\Repositories\cumiLab_rateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class cumiLab_rateRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var cumiLab_rateRepository
     */
    protected $cumiLabRateRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cumiLabRateRepo = \App::make(cumiLab_rateRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cumi_lab_rate()
    {
        $cumiLabRate = cumiLab_rate::factory()->make()->toArray();

        $createdcumiLab_rate = $this->cumiLabRateRepo->create($cumiLabRate);

        $createdcumiLab_rate = $createdcumiLab_rate->toArray();
        $this->assertArrayHasKey('id', $createdcumiLab_rate);
        $this->assertNotNull($createdcumiLab_rate['id'], 'Created cumiLab_rate must have id specified');
        $this->assertNotNull(cumiLab_rate::find($createdcumiLab_rate['id']), 'cumiLab_rate with given id must be in DB');
        $this->assertModelData($cumiLabRate, $createdcumiLab_rate);
    }

    /**
     * @test read
     */
    public function test_read_cumi_lab_rate()
    {
        $cumiLabRate = cumiLab_rate::factory()->create();

        $dbcumiLab_rate = $this->cumiLabRateRepo->find($cumiLabRate->id);

        $dbcumiLab_rate = $dbcumiLab_rate->toArray();
        $this->assertModelData($cumiLabRate->toArray(), $dbcumiLab_rate);
    }

    /**
     * @test update
     */
    public function test_update_cumi_lab_rate()
    {
        $cumiLabRate = cumiLab_rate::factory()->create();
        $fakecumiLab_rate = cumiLab_rate::factory()->make()->toArray();

        $updatedcumiLab_rate = $this->cumiLabRateRepo->update($fakecumiLab_rate, $cumiLabRate->id);

        $this->assertModelData($fakecumiLab_rate, $updatedcumiLab_rate->toArray());
        $dbcumiLab_rate = $this->cumiLabRateRepo->find($cumiLabRate->id);
        $this->assertModelData($fakecumiLab_rate, $dbcumiLab_rate->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cumi_lab_rate()
    {
        $cumiLabRate = cumiLab_rate::factory()->create();

        $resp = $this->cumiLabRateRepo->delete($cumiLabRate->id);

        $this->assertTrue($resp);
        $this->assertNull(cumiLab_rate::find($cumiLabRate->id), 'cumiLab_rate should not exist in DB');
    }
}
