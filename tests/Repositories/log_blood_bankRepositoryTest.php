<?php namespace Tests\Repositories;

use App\Models\log_blood_bank;
use App\Repositories\log_blood_bankRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class log_blood_bankRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var log_blood_bankRepository
     */
    protected $logBloodBankRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->logBloodBankRepo = \App::make(log_blood_bankRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_log_blood_bank()
    {
        $logBloodBank = log_blood_bank::factory()->make()->toArray();

        $createdlog_blood_bank = $this->logBloodBankRepo->create($logBloodBank);

        $createdlog_blood_bank = $createdlog_blood_bank->toArray();
        $this->assertArrayHasKey('id', $createdlog_blood_bank);
        $this->assertNotNull($createdlog_blood_bank['id'], 'Created log_blood_bank must have id specified');
        $this->assertNotNull(log_blood_bank::find($createdlog_blood_bank['id']), 'log_blood_bank with given id must be in DB');
        $this->assertModelData($logBloodBank, $createdlog_blood_bank);
    }

    /**
     * @test read
     */
    public function test_read_log_blood_bank()
    {
        $logBloodBank = log_blood_bank::factory()->create();

        $dblog_blood_bank = $this->logBloodBankRepo->find($logBloodBank->id);

        $dblog_blood_bank = $dblog_blood_bank->toArray();
        $this->assertModelData($logBloodBank->toArray(), $dblog_blood_bank);
    }

    /**
     * @test update
     */
    public function test_update_log_blood_bank()
    {
        $logBloodBank = log_blood_bank::factory()->create();
        $fakelog_blood_bank = log_blood_bank::factory()->make()->toArray();

        $updatedlog_blood_bank = $this->logBloodBankRepo->update($fakelog_blood_bank, $logBloodBank->id);

        $this->assertModelData($fakelog_blood_bank, $updatedlog_blood_bank->toArray());
        $dblog_blood_bank = $this->logBloodBankRepo->find($logBloodBank->id);
        $this->assertModelData($fakelog_blood_bank, $dblog_blood_bank->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_log_blood_bank()
    {
        $logBloodBank = log_blood_bank::factory()->create();

        $resp = $this->logBloodBankRepo->delete($logBloodBank->id);

        $this->assertTrue($resp);
        $this->assertNull(log_blood_bank::find($logBloodBank->id), 'log_blood_bank should not exist in DB');
    }
}
