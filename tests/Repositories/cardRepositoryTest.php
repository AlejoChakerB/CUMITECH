<?php namespace Tests\Repositories;

use App\Models\card;
use App\Repositories\cardRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class cardRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var cardRepository
     */
    protected $cardRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cardRepo = \App::make(cardRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_card()
    {
        $card = card::factory()->make()->toArray();

        $createdcard = $this->cardRepo->create($card);

        $createdcard = $createdcard->toArray();
        $this->assertArrayHasKey('id', $createdcard);
        $this->assertNotNull($createdcard['id'], 'Created card must have id specified');
        $this->assertNotNull(card::find($createdcard['id']), 'card with given id must be in DB');
        $this->assertModelData($card, $createdcard);
    }

    /**
     * @test read
     */
    public function test_read_card()
    {
        $card = card::factory()->create();

        $dbcard = $this->cardRepo->find($card->id);

        $dbcard = $dbcard->toArray();
        $this->assertModelData($card->toArray(), $dbcard);
    }

    /**
     * @test update
     */
    public function test_update_card()
    {
        $card = card::factory()->create();
        $fakecard = card::factory()->make()->toArray();

        $updatedcard = $this->cardRepo->update($fakecard, $card->id);

        $this->assertModelData($fakecard, $updatedcard->toArray());
        $dbcard = $this->cardRepo->find($card->id);
        $this->assertModelData($fakecard, $dbcard->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_card()
    {
        $card = card::factory()->create();

        $resp = $this->cardRepo->delete($card->id);

        $this->assertTrue($resp);
        $this->assertNull(card::find($card->id), 'card should not exist in DB');
    }
}
