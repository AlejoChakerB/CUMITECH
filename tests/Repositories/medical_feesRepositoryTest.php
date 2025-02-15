<?php namespace Tests\Repositories;

use App\Models\medical_fees;
use App\Repositories\medical_feesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class medical_feesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var medical_feesRepository
     */
    protected $medicalFeesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicalFeesRepo = \App::make(medical_feesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medical_fees()
    {
        $medicalFees = medical_fees::factory()->make()->toArray();

        $createdmedical_fees = $this->medicalFeesRepo->create($medicalFees);

        $createdmedical_fees = $createdmedical_fees->toArray();
        $this->assertArrayHasKey('id', $createdmedical_fees);
        $this->assertNotNull($createdmedical_fees['id'], 'Created medical_fees must have id specified');
        $this->assertNotNull(medical_fees::find($createdmedical_fees['id']), 'medical_fees with given id must be in DB');
        $this->assertModelData($medicalFees, $createdmedical_fees);
    }

    /**
     * @test read
     */
    public function test_read_medical_fees()
    {
        $medicalFees = medical_fees::factory()->create();

        $dbmedical_fees = $this->medicalFeesRepo->find($medicalFees->id);

        $dbmedical_fees = $dbmedical_fees->toArray();
        $this->assertModelData($medicalFees->toArray(), $dbmedical_fees);
    }

    /**
     * @test update
     */
    public function test_update_medical_fees()
    {
        $medicalFees = medical_fees::factory()->create();
        $fakemedical_fees = medical_fees::factory()->make()->toArray();

        $updatedmedical_fees = $this->medicalFeesRepo->update($fakemedical_fees, $medicalFees->id);

        $this->assertModelData($fakemedical_fees, $updatedmedical_fees->toArray());
        $dbmedical_fees = $this->medicalFeesRepo->find($medicalFees->id);
        $this->assertModelData($fakemedical_fees, $dbmedical_fees->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medical_fees()
    {
        $medicalFees = medical_fees::factory()->create();

        $resp = $this->medicalFeesRepo->delete($medicalFees->id);

        $this->assertTrue($resp);
        $this->assertNull(medical_fees::find($medicalFees->id), 'medical_fees should not exist in DB');
    }
}
