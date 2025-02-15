<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\stand_assistance;

class stand_assistanceApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stand_assistance()
    {
        $standAssistance = stand_assistance::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stand_assistances', $standAssistance
        );

        $this->assertApiResponse($standAssistance);
    }

    /**
     * @test
     */
    public function test_read_stand_assistance()
    {
        $standAssistance = stand_assistance::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/stand_assistances/'.$standAssistance->id
        );

        $this->assertApiResponse($standAssistance->toArray());
    }

    /**
     * @test
     */
    public function test_update_stand_assistance()
    {
        $standAssistance = stand_assistance::factory()->create();
        $editedstand_assistance = stand_assistance::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stand_assistances/'.$standAssistance->id,
            $editedstand_assistance
        );

        $this->assertApiResponse($editedstand_assistance);
    }

    /**
     * @test
     */
    public function test_delete_stand_assistance()
    {
        $standAssistance = stand_assistance::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stand_assistances/'.$standAssistance->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stand_assistances/'.$standAssistance->id
        );

        $this->response->assertStatus(404);
    }
}
