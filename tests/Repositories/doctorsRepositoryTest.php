<?php namespace Tests\Repositories;

use App\Models\doctors;
use App\Repositories\doctorsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class doctorsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var doctorsRepository
     */
    protected $doctorsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->doctorsRepo = \App::make(doctorsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_doctors()
    {
        $doctors = doctors::factory()->make()->toArray();

        $createddoctors = $this->doctorsRepo->create($doctors);

        $createddoctors = $createddoctors->toArray();
        $this->assertArrayHasKey('id', $createddoctors);
        $this->assertNotNull($createddoctors['id'], 'Created doctors must have id specified');
        $this->assertNotNull(doctors::find($createddoctors['id']), 'doctors with given id must be in DB');
        $this->assertModelData($doctors, $createddoctors);
    }

    /**
     * @test read
     */
    public function test_read_doctors()
    {
        $doctors = doctors::factory()->create();

        $dbdoctors = $this->doctorsRepo->find($doctors->id);

        $dbdoctors = $dbdoctors->toArray();
        $this->assertModelData($doctors->toArray(), $dbdoctors);
    }

    /**
     * @test update
     */
    public function test_update_doctors()
    {
        $doctors = doctors::factory()->create();
        $fakedoctors = doctors::factory()->make()->toArray();

        $updateddoctors = $this->doctorsRepo->update($fakedoctors, $doctors->id);

        $this->assertModelData($fakedoctors, $updateddoctors->toArray());
        $dbdoctors = $this->doctorsRepo->find($doctors->id);
        $this->assertModelData($fakedoctors, $dbdoctors->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_doctors()
    {
        $doctors = doctors::factory()->create();

        $resp = $this->doctorsRepo->delete($doctors->id);

        $this->assertTrue($resp);
        $this->assertNull(doctors::find($doctors->id), 'doctors should not exist in DB');
    }
}
