<?php namespace Tests\Repositories;

use App\Models\medicationTemplate;
use App\Repositories\medicationTemplateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class medicationTemplateRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var medicationTemplateRepository
     */
    protected $medicationTemplateRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicationTemplateRepo = \App::make(medicationTemplateRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medication_template()
    {
        $medicationTemplate = medicationTemplate::factory()->make()->toArray();

        $createdmedicationTemplate = $this->medicationTemplateRepo->create($medicationTemplate);

        $createdmedicationTemplate = $createdmedicationTemplate->toArray();
        $this->assertArrayHasKey('id', $createdmedicationTemplate);
        $this->assertNotNull($createdmedicationTemplate['id'], 'Created medicationTemplate must have id specified');
        $this->assertNotNull(medicationTemplate::find($createdmedicationTemplate['id']), 'medicationTemplate with given id must be in DB');
        $this->assertModelData($medicationTemplate, $createdmedicationTemplate);
    }

    /**
     * @test read
     */
    public function test_read_medication_template()
    {
        $medicationTemplate = medicationTemplate::factory()->create();

        $dbmedicationTemplate = $this->medicationTemplateRepo->find($medicationTemplate->id);

        $dbmedicationTemplate = $dbmedicationTemplate->toArray();
        $this->assertModelData($medicationTemplate->toArray(), $dbmedicationTemplate);
    }

    /**
     * @test update
     */
    public function test_update_medication_template()
    {
        $medicationTemplate = medicationTemplate::factory()->create();
        $fakemedicationTemplate = medicationTemplate::factory()->make()->toArray();

        $updatedmedicationTemplate = $this->medicationTemplateRepo->update($fakemedicationTemplate, $medicationTemplate->id);

        $this->assertModelData($fakemedicationTemplate, $updatedmedicationTemplate->toArray());
        $dbmedicationTemplate = $this->medicationTemplateRepo->find($medicationTemplate->id);
        $this->assertModelData($fakemedicationTemplate, $dbmedicationTemplate->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medication_template()
    {
        $medicationTemplate = medicationTemplate::factory()->create();

        $resp = $this->medicationTemplateRepo->delete($medicationTemplate->id);

        $this->assertTrue($resp);
        $this->assertNull(medicationTemplate::find($medicationTemplate->id), 'medicationTemplate should not exist in DB');
    }
}
