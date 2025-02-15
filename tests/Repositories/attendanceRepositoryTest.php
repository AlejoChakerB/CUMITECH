<?php namespace Tests\Repositories;

use App\Models\attendance;
use App\Repositories\attendanceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class attendanceRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var attendanceRepository
     */
    protected $attendanceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->attendanceRepo = \App::make(attendanceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_attendance()
    {
        $attendance = attendance::factory()->make()->toArray();

        $createdattendance = $this->attendanceRepo->create($attendance);

        $createdattendance = $createdattendance->toArray();
        $this->assertArrayHasKey('id', $createdattendance);
        $this->assertNotNull($createdattendance['id'], 'Created attendance must have id specified');
        $this->assertNotNull(attendance::find($createdattendance['id']), 'attendance with given id must be in DB');
        $this->assertModelData($attendance, $createdattendance);
    }

    /**
     * @test read
     */
    public function test_read_attendance()
    {
        $attendance = attendance::factory()->create();

        $dbattendance = $this->attendanceRepo->find($attendance->id);

        $dbattendance = $dbattendance->toArray();
        $this->assertModelData($attendance->toArray(), $dbattendance);
    }

    /**
     * @test update
     */
    public function test_update_attendance()
    {
        $attendance = attendance::factory()->create();
        $fakeattendance = attendance::factory()->make()->toArray();

        $updatedattendance = $this->attendanceRepo->update($fakeattendance, $attendance->id);

        $this->assertModelData($fakeattendance, $updatedattendance->toArray());
        $dbattendance = $this->attendanceRepo->find($attendance->id);
        $this->assertModelData($fakeattendance, $dbattendance->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_attendance()
    {
        $attendance = attendance::factory()->create();

        $resp = $this->attendanceRepo->delete($attendance->id);

        $this->assertTrue($resp);
        $this->assertNull(attendance::find($attendance->id), 'attendance should not exist in DB');
    }
}
