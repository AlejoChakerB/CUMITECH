<?php namespace Tests\Repositories;

use App\Models\doctors_changes;
use App\Repositories\doctors_changesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class doctors_changesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var doctors_changesRepository
     */
    protected $doctorsChangesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->doctorsChangesRepo = \App::make(doctors_changesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_doctors_changes()
    {
        $doctorsChanges = doctors_changes::factory()->make()->toArray();

        $createddoctors_changes = $this->doctorsChangesRepo->create($doctorsChanges);

        $createddoctors_changes = $createddoctors_changes->toArray();
        $this->assertArrayHasKey('id', $createddoctors_changes);
        $this->assertNotNull($createddoctors_changes['id'], 'Created doctors_changes must have id specified');
        $this->assertNotNull(doctors_changes::find($createddoctors_changes['id']), 'doctors_changes with given id must be in DB');
        $this->assertModelData($doctorsChanges, $createddoctors_changes);
    }

    /**
     * @test read
     */
    public function test_read_doctors_changes()
    {
        $doctorsChanges = doctors_changes::factory()->create();

        $dbdoctors_changes = $this->doctorsChangesRepo->find($doctorsChanges->id);

        $dbdoctors_changes = $dbdoctors_changes->toArray();
        $this->assertModelData($doctorsChanges->toArray(), $dbdoctors_changes);
    }

    /**
     * @test update
     */
    public function test_update_doctors_changes()
    {
        $doctorsChanges = doctors_changes::factory()->create();
        $fakedoctors_changes = doctors_changes::factory()->make()->toArray();

        $updateddoctors_changes = $this->doctorsChangesRepo->update($fakedoctors_changes, $doctorsChanges->id);

        $this->assertModelData($fakedoctors_changes, $updateddoctors_changes->toArray());
        $dbdoctors_changes = $this->doctorsChangesRepo->find($doctorsChanges->id);
        $this->assertModelData($fakedoctors_changes, $dbdoctors_changes->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_doctors_changes()
    {
        $doctorsChanges = doctors_changes::factory()->create();

        $resp = $this->doctorsChangesRepo->delete($doctorsChanges->id);

        $this->assertTrue($resp);
        $this->assertNull(doctors_changes::find($doctorsChanges->id), 'doctors_changes should not exist in DB');
    }
}
