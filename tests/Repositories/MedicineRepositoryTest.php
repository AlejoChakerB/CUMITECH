<?php namespace Tests\Repositories;

use App\Models\Medicine;
use App\Repositories\MedicineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MedicineRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicineRepository
     */
    protected $medicineRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicineRepo = \App::make(MedicineRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medicine()
    {
        $medicine = Medicine::factory()->make()->toArray();

        $createdMedicine = $this->medicineRepo->create($medicine);

        $createdMedicine = $createdMedicine->toArray();
        $this->assertArrayHasKey('id', $createdMedicine);
        $this->assertNotNull($createdMedicine['id'], 'Created Medicine must have id specified');
        $this->assertNotNull(Medicine::find($createdMedicine['id']), 'Medicine with given id must be in DB');
        $this->assertModelData($medicine, $createdMedicine);
    }

    /**
     * @test read
     */
    public function test_read_medicine()
    {
        $medicine = Medicine::factory()->create();

        $dbMedicine = $this->medicineRepo->find($medicine->id);

        $dbMedicine = $dbMedicine->toArray();
        $this->assertModelData($medicine->toArray(), $dbMedicine);
    }

    /**
     * @test update
     */
    public function test_update_medicine()
    {
        $medicine = Medicine::factory()->create();
        $fakeMedicine = Medicine::factory()->make()->toArray();

        $updatedMedicine = $this->medicineRepo->update($fakeMedicine, $medicine->id);

        $this->assertModelData($fakeMedicine, $updatedMedicine->toArray());
        $dbMedicine = $this->medicineRepo->find($medicine->id);
        $this->assertModelData($fakeMedicine, $dbMedicine->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medicine()
    {
        $medicine = Medicine::factory()->create();

        $resp = $this->medicineRepo->delete($medicine->id);

        $this->assertTrue($resp);
        $this->assertNull(Medicine::find($medicine->id), 'Medicine should not exist in DB');
    }
}
