<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\attendance;

class attendanceApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_attendance()
    {
        $attendance = attendance::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/attendances', $attendance
        );

        $this->assertApiResponse($attendance);
    }

    /**
     * @test
     */
    public function test_read_attendance()
    {
        $attendance = attendance::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/attendances/'.$attendance->id
        );

        $this->assertApiResponse($attendance->toArray());
    }

    /**
     * @test
     */
    public function test_update_attendance()
    {
        $attendance = attendance::factory()->create();
        $editedattendance = attendance::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/attendances/'.$attendance->id,
            $editedattendance
        );

        $this->assertApiResponse($editedattendance);
    }

    /**
     * @test
     */
    public function test_delete_attendance()
    {
        $attendance = attendance::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/attendances/'.$attendance->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/attendances/'.$attendance->id
        );

        $this->response->assertStatus(404);
    }
}
