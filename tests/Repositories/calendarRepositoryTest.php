<?php namespace Tests\Repositories;

use App\Models\calendar;
use App\Repositories\calendarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class calendarRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var calendarRepository
     */
    protected $calendarRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->calendarRepo = \App::make(calendarRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_calendar()
    {
        $calendar = calendar::factory()->make()->toArray();

        $createdcalendar = $this->calendarRepo->create($calendar);

        $createdcalendar = $createdcalendar->toArray();
        $this->assertArrayHasKey('id', $createdcalendar);
        $this->assertNotNull($createdcalendar['id'], 'Created calendar must have id specified');
        $this->assertNotNull(calendar::find($createdcalendar['id']), 'calendar with given id must be in DB');
        $this->assertModelData($calendar, $createdcalendar);
    }

    /**
     * @test read
     */
    public function test_read_calendar()
    {
        $calendar = calendar::factory()->create();

        $dbcalendar = $this->calendarRepo->find($calendar->id);

        $dbcalendar = $dbcalendar->toArray();
        $this->assertModelData($calendar->toArray(), $dbcalendar);
    }

    /**
     * @test update
     */
    public function test_update_calendar()
    {
        $calendar = calendar::factory()->create();
        $fakecalendar = calendar::factory()->make()->toArray();

        $updatedcalendar = $this->calendarRepo->update($fakecalendar, $calendar->id);

        $this->assertModelData($fakecalendar, $updatedcalendar->toArray());
        $dbcalendar = $this->calendarRepo->find($calendar->id);
        $this->assertModelData($fakecalendar, $dbcalendar->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_calendar()
    {
        $calendar = calendar::factory()->create();

        $resp = $this->calendarRepo->delete($calendar->id);

        $this->assertTrue($resp);
        $this->assertNull(calendar::find($calendar->id), 'calendar should not exist in DB');
    }
}
