<?php namespace Tests\Repositories;

use App\Models\blood_bank_month;
use App\Repositories\blood_bank_monthRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class blood_bank_monthRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var blood_bank_monthRepository
     */
    protected $bloodBankMonthRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bloodBankMonthRepo = \App::make(blood_bank_monthRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_blood_bank_month()
    {
        $bloodBankMonth = blood_bank_month::factory()->make()->toArray();

        $createdblood_bank_month = $this->bloodBankMonthRepo->create($bloodBankMonth);

        $createdblood_bank_month = $createdblood_bank_month->toArray();
        $this->assertArrayHasKey('id', $createdblood_bank_month);
        $this->assertNotNull($createdblood_bank_month['id'], 'Created blood_bank_month must have id specified');
        $this->assertNotNull(blood_bank_month::find($createdblood_bank_month['id']), 'blood_bank_month with given id must be in DB');
        $this->assertModelData($bloodBankMonth, $createdblood_bank_month);
    }

    /**
     * @test read
     */
    public function test_read_blood_bank_month()
    {
        $bloodBankMonth = blood_bank_month::factory()->create();

        $dbblood_bank_month = $this->bloodBankMonthRepo->find($bloodBankMonth->id);

        $dbblood_bank_month = $dbblood_bank_month->toArray();
        $this->assertModelData($bloodBankMonth->toArray(), $dbblood_bank_month);
    }

    /**
     * @test update
     */
    public function test_update_blood_bank_month()
    {
        $bloodBankMonth = blood_bank_month::factory()->create();
        $fakeblood_bank_month = blood_bank_month::factory()->make()->toArray();

        $updatedblood_bank_month = $this->bloodBankMonthRepo->update($fakeblood_bank_month, $bloodBankMonth->id);

        $this->assertModelData($fakeblood_bank_month, $updatedblood_bank_month->toArray());
        $dbblood_bank_month = $this->bloodBankMonthRepo->find($bloodBankMonth->id);
        $this->assertModelData($fakeblood_bank_month, $dbblood_bank_month->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_blood_bank_month()
    {
        $bloodBankMonth = blood_bank_month::factory()->create();

        $resp = $this->bloodBankMonthRepo->delete($bloodBankMonth->id);

        $this->assertTrue($resp);
        $this->assertNull(blood_bank_month::find($bloodBankMonth->id), 'blood_bank_month should not exist in DB');
    }
}
