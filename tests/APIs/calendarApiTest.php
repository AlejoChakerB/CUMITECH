<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\calendar;

class calendarApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_calendar()
    {
        $calendar = calendar::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/calendars', $calendar
        );

        $this->assertApiResponse($calendar);
    }

    /**
     * @test
     */
    public function test_read_calendar()
    {
        $calendar = calendar::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/calendars/'.$calendar->id
        );

        $this->assertApiResponse($calendar->toArray());
    }

    /**
     * @test
     */
    public function test_update_calendar()
    {
        $calendar = calendar::factory()->create();
        $editedcalendar = calendar::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/calendars/'.$calendar->id,
            $editedcalendar
        );

        $this->assertApiResponse($editedcalendar);
    }

    /**
     * @test
     */
    public function test_delete_calendar()
    {
        $calendar = calendar::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/calendars/'.$calendar->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/calendars/'.$calendar->id
        );

        $this->response->assertStatus(404);
    }
}
