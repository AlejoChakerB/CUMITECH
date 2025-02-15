<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\invima_registration;

class invima_registrationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_invima_registration()
    {
        $invimaRegistration = invima_registration::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/invima_registrations', $invimaRegistration
        );

        $this->assertApiResponse($invimaRegistration);
    }

    /**
     * @test
     */
    public function test_read_invima_registration()
    {
        $invimaRegistration = invima_registration::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/invima_registrations/'.$invimaRegistration->id
        );

        $this->assertApiResponse($invimaRegistration->toArray());
    }

    /**
     * @test
     */
    public function test_update_invima_registration()
    {
        $invimaRegistration = invima_registration::factory()->create();
        $editedinvima_registration = invima_registration::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/invima_registrations/'.$invimaRegistration->id,
            $editedinvima_registration
        );

        $this->assertApiResponse($editedinvima_registration);
    }

    /**
     * @test
     */
    public function test_delete_invima_registration()
    {
        $invimaRegistration = invima_registration::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/invima_registrations/'.$invimaRegistration->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/invima_registrations/'.$invimaRegistration->id
        );

        $this->response->assertStatus(404);
    }
}
