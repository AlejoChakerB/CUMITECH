<?php namespace Tests\Repositories;

use App\Models\rented_equipment;
use App\Repositories\rented_equipmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class rented_equipmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var rented_equipmentRepository
     */
    protected $rentedEquipmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rentedEquipmentRepo = \App::make(rented_equipmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rented_equipment()
    {
        $rentedEquipment = rented_equipment::factory()->make()->toArray();

        $createdrented_equipment = $this->rentedEquipmentRepo->create($rentedEquipment);

        $createdrented_equipment = $createdrented_equipment->toArray();
        $this->assertArrayHasKey('id', $createdrented_equipment);
        $this->assertNotNull($createdrented_equipment['id'], 'Created rented_equipment must have id specified');
        $this->assertNotNull(rented_equipment::find($createdrented_equipment['id']), 'rented_equipment with given id must be in DB');
        $this->assertModelData($rentedEquipment, $createdrented_equipment);
    }

    /**
     * @test read
     */
    public function test_read_rented_equipment()
    {
        $rentedEquipment = rented_equipment::factory()->create();

        $dbrented_equipment = $this->rentedEquipmentRepo->find($rentedEquipment->id);

        $dbrented_equipment = $dbrented_equipment->toArray();
        $this->assertModelData($rentedEquipment->toArray(), $dbrented_equipment);
    }

    /**
     * @test update
     */
    public function test_update_rented_equipment()
    {
        $rentedEquipment = rented_equipment::factory()->create();
        $fakerented_equipment = rented_equipment::factory()->make()->toArray();

        $updatedrented_equipment = $this->rentedEquipmentRepo->update($fakerented_equipment, $rentedEquipment->id);

        $this->assertModelData($fakerented_equipment, $updatedrented_equipment->toArray());
        $dbrented_equipment = $this->rentedEquipmentRepo->find($rentedEquipment->id);
        $this->assertModelData($fakerented_equipment, $dbrented_equipment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rented_equipment()
    {
        $rentedEquipment = rented_equipment::factory()->create();

        $resp = $this->rentedEquipmentRepo->delete($rentedEquipment->id);

        $this->assertTrue($resp);
        $this->assertNull(rented_equipment::find($rentedEquipment->id), 'rented_equipment should not exist in DB');
    }
}
