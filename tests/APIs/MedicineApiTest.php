<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Medicine;

class MedicineApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medicine()
    {
        $medicine = Medicine::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/medicines', $medicine
        );

        $this->assertApiResponse($medicine);
    }

    /**
     * @test
     */
    public function test_read_medicine()
    {
        $medicine = Medicine::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/medicines/'.$medicine->id
        );

        $this->assertApiResponse($medicine->toArray());
    }

    /**
     * @test
     */
    public function test_update_medicine()
    {
        $medicine = Medicine::factory()->create();
        $editedMedicine = Medicine::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/medicines/'.$medicine->id,
            $editedMedicine
        );

        $this->assertApiResponse($editedMedicine);
    }

    /**
     * @test
     */
    public function test_delete_medicine()
    {
        $medicine = Medicine::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/medicines/'.$medicine->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/medicines/'.$medicine->id
        );

        $this->response->assertStatus(404);
    }
}
