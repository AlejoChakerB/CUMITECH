<?php namespace Tests\Repositories;

use App\Models\invima_registration;
use App\Repositories\invima_registrationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class invima_registrationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var invima_registrationRepository
     */
    protected $invimaRegistrationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->invimaRegistrationRepo = \App::make(invima_registrationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_invima_registration()
    {
        $invimaRegistration = invima_registration::factory()->make()->toArray();

        $createdinvima_registration = $this->invimaRegistrationRepo->create($invimaRegistration);

        $createdinvima_registration = $createdinvima_registration->toArray();
        $this->assertArrayHasKey('id', $createdinvima_registration);
        $this->assertNotNull($createdinvima_registration['id'], 'Created invima_registration must have id specified');
        $this->assertNotNull(invima_registration::find($createdinvima_registration['id']), 'invima_registration with given id must be in DB');
        $this->assertModelData($invimaRegistration, $createdinvima_registration);
    }

    /**
     * @test read
     */
    public function test_read_invima_registration()
    {
        $invimaRegistration = invima_registration::factory()->create();

        $dbinvima_registration = $this->invimaRegistrationRepo->find($invimaRegistration->id);

        $dbinvima_registration = $dbinvima_registration->toArray();
        $this->assertModelData($invimaRegistration->toArray(), $dbinvima_registration);
    }

    /**
     * @test update
     */
    public function test_update_invima_registration()
    {
        $invimaRegistration = invima_registration::factory()->create();
        $fakeinvima_registration = invima_registration::factory()->make()->toArray();

        $updatedinvima_registration = $this->invimaRegistrationRepo->update($fakeinvima_registration, $invimaRegistration->id);

        $this->assertModelData($fakeinvima_registration, $updatedinvima_registration->toArray());
        $dbinvima_registration = $this->invimaRegistrationRepo->find($invimaRegistration->id);
        $this->assertModelData($fakeinvima_registration, $dbinvima_registration->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_invima_registration()
    {
        $invimaRegistration = invima_registration::factory()->create();

        $resp = $this->invimaRegistrationRepo->delete($invimaRegistration->id);

        $this->assertTrue($resp);
        $this->assertNull(invima_registration::find($invimaRegistration->id), 'invima_registration should not exist in DB');
    }
}
