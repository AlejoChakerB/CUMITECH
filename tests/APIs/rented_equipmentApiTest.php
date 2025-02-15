<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\rented_equipment;

class rented_equipmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rented_equipment()
    {
        $rentedEquipment = rented_equipment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rented_equipments', $rentedEquipment
        );

        $this->assertApiResponse($rentedEquipment);
    }

    /**
     * @test
     */
    public function test_read_rented_equipment()
    {
        $rentedEquipment = rented_equipment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/rented_equipments/'.$rentedEquipment->id
        );

        $this->assertApiResponse($rentedEquipment->toArray());
    }

    /**
     * @test
     */
    public function test_update_rented_equipment()
    {
        $rentedEquipment = rented_equipment::factory()->create();
        $editedrented_equipment = rented_equipment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rented_equipments/'.$rentedEquipment->id,
            $editedrented_equipment
        );

        $this->assertApiResponse($editedrented_equipment);
    }

    /**
     * @test
     */
    public function test_delete_rented_equipment()
    {
        $rentedEquipment = rented_equipment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rented_equipments/'.$rentedEquipment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rented_equipments/'.$rentedEquipment->id
        );

        $this->response->assertStatus(404);
    }
}
