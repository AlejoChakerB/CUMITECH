<?php namespace Tests\Repositories;

use App\Models\accommodation_cost;
use App\Repositories\accommodation_costRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class accommodation_costRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var accommodation_costRepository
     */
    protected $accommodationCostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->accommodationCostRepo = \App::make(accommodation_costRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_accommodation_cost()
    {
        $accommodationCost = accommodation_cost::factory()->make()->toArray();

        $createdaccommodation_cost = $this->accommodationCostRepo->create($accommodationCost);

        $createdaccommodation_cost = $createdaccommodation_cost->toArray();
        $this->assertArrayHasKey('id', $createdaccommodation_cost);
        $this->assertNotNull($createdaccommodation_cost['id'], 'Created accommodation_cost must have id specified');
        $this->assertNotNull(accommodation_cost::find($createdaccommodation_cost['id']), 'accommodation_cost with given id must be in DB');
        $this->assertModelData($accommodationCost, $createdaccommodation_cost);
    }

    /**
     * @test read
     */
    public function test_read_accommodation_cost()
    {
        $accommodationCost = accommodation_cost::factory()->create();

        $dbaccommodation_cost = $this->accommodationCostRepo->find($accommodationCost->id);

        $dbaccommodation_cost = $dbaccommodation_cost->toArray();
        $this->assertModelData($accommodationCost->toArray(), $dbaccommodation_cost);
    }

    /**
     * @test update
     */
    public function test_update_accommodation_cost()
    {
        $accommodationCost = accommodation_cost::factory()->create();
        $fakeaccommodation_cost = accommodation_cost::factory()->make()->toArray();

        $updatedaccommodation_cost = $this->accommodationCostRepo->update($fakeaccommodation_cost, $accommodationCost->id);

        $this->assertModelData($fakeaccommodation_cost, $updatedaccommodation_cost->toArray());
        $dbaccommodation_cost = $this->accommodationCostRepo->find($accommodationCost->id);
        $this->assertModelData($fakeaccommodation_cost, $dbaccommodation_cost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_accommodation_cost()
    {
        $accommodationCost = accommodation_cost::factory()->create();

        $resp = $this->accommodationCostRepo->delete($accommodationCost->id);

        $this->assertTrue($resp);
        $this->assertNull(accommodation_cost::find($accommodationCost->id), 'accommodation_cost should not exist in DB');
    }
}
