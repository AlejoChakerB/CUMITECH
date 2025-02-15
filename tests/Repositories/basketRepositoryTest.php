<?php namespace Tests\Repositories;

use App\Models\basket;
use App\Repositories\basketRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class basketRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var basketRepository
     */
    protected $basketRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->basketRepo = \App::make(basketRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_basket()
    {
        $basket = basket::factory()->make()->toArray();

        $createdbasket = $this->basketRepo->create($basket);

        $createdbasket = $createdbasket->toArray();
        $this->assertArrayHasKey('id', $createdbasket);
        $this->assertNotNull($createdbasket['id'], 'Created basket must have id specified');
        $this->assertNotNull(basket::find($createdbasket['id']), 'basket with given id must be in DB');
        $this->assertModelData($basket, $createdbasket);
    }

    /**
     * @test read
     */
    public function test_read_basket()
    {
        $basket = basket::factory()->create();

        $dbbasket = $this->basketRepo->find($basket->id);

        $dbbasket = $dbbasket->toArray();
        $this->assertModelData($basket->toArray(), $dbbasket);
    }

    /**
     * @test update
     */
    public function test_update_basket()
    {
        $basket = basket::factory()->create();
        $fakebasket = basket::factory()->make()->toArray();

        $updatedbasket = $this->basketRepo->update($fakebasket, $basket->id);

        $this->assertModelData($fakebasket, $updatedbasket->toArray());
        $dbbasket = $this->basketRepo->find($basket->id);
        $this->assertModelData($fakebasket, $dbbasket->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_basket()
    {
        $basket = basket::factory()->create();

        $resp = $this->basketRepo->delete($basket->id);

        $this->assertTrue($resp);
        $this->assertNull(basket::find($basket->id), 'basket should not exist in DB');
    }
}
