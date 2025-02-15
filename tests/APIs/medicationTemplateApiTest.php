<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\medicationTemplate;

class medicationTemplateApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medication_template()
    {
        $medicationTemplate = medicationTemplate::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/medication_templates', $medicationTemplate
        );

        $this->assertApiResponse($medicationTemplate);
    }

    /**
     * @test
     */
    public function test_read_medication_template()
    {
        $medicationTemplate = medicationTemplate::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/medication_templates/'.$medicationTemplate->id
        );

        $this->assertApiResponse($medicationTemplate->toArray());
    }

    /**
     * @test
     */
    public function test_update_medication_template()
    {
        $medicationTemplate = medicationTemplate::factory()->create();
        $editedmedicationTemplate = medicationTemplate::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/medication_templates/'.$medicationTemplate->id,
            $editedmedicationTemplate
        );

        $this->assertApiResponse($editedmedicationTemplate);
    }

    /**
     * @test
     */
    public function test_delete_medication_template()
    {
        $medicationTemplate = medicationTemplate::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/medication_templates/'.$medicationTemplate->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/medication_templates/'.$medicationTemplate->id
        );

        $this->response->assertStatus(404);
    }
}
