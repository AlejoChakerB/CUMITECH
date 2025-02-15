<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\medical_fees;

class medical_feesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medical_fees()
    {
        $medicalFees = medical_fees::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/medical_fees', $medicalFees
        );

        $this->assertApiResponse($medicalFees);
    }

    /**
     * @test
     */
    public function test_read_medical_fees()
    {
        $medicalFees = medical_fees::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/medical_fees/'.$medicalFees->id
        );

        $this->assertApiResponse($medicalFees->toArray());
    }

    /**
     * @test
     */
    public function test_update_medical_fees()
    {
        $medicalFees = medical_fees::factory()->create();
        $editedmedical_fees = medical_fees::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/medical_fees/'.$medicalFees->id,
            $editedmedical_fees
        );

        $this->assertApiResponse($editedmedical_fees);
    }

    /**
     * @test
     */
    public function test_delete_medical_fees()
    {
        $medicalFees = medical_fees::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/medical_fees/'.$medicalFees->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/medical_fees/'.$medicalFees->id
        );

        $this->response->assertStatus(404);
    }
}
