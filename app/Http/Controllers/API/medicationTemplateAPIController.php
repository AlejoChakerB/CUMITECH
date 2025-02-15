<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemedicationTemplateAPIRequest;
use App\Http\Requests\API\UpdatemedicationTemplateAPIRequest;
use App\Models\medicationTemplate;
use App\Repositories\medicationTemplateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class medicationTemplateController
 * @package App\Http\Controllers\API
 */

class medicationTemplateAPIController extends AppBaseController
{
    /** @var  medicationTemplateRepository */
    private $medicationTemplateRepository;

    public function __construct(medicationTemplateRepository $medicationTemplateRepo)
    {
        $this->medicationTemplateRepository = $medicationTemplateRepo;
    }

    /**
     * Display a listing of the medicationTemplate.
     * GET|HEAD /medicationTemplates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $medicationTemplates = $this->medicationTemplateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($medicationTemplates->toArray(), 'Medication Templates retrieved successfully');
    }

    /**
     * Store a newly created medicationTemplate in storage.
     * POST /medicationTemplates
     *
     * @param CreatemedicationTemplateAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemedicationTemplateAPIRequest $request)
    {
        $input = $request->all();

        $medicationTemplate = $this->medicationTemplateRepository->create($input);

        return $this->sendResponse($medicationTemplate->toArray(), 'Medication Template saved successfully');
    }

    /**
     * Display the specified medicationTemplate.
     * GET|HEAD /medicationTemplates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var medicationTemplate $medicationTemplate */
        $medicationTemplate = $this->medicationTemplateRepository->find($id);

        if (empty($medicationTemplate)) {
            return $this->sendError('Medication Template not found');
        }

        return $this->sendResponse($medicationTemplate->toArray(), 'Medication Template retrieved successfully');
    }

    /**
     * Update the specified medicationTemplate in storage.
     * PUT/PATCH /medicationTemplates/{id}
     *
     * @param int $id
     * @param UpdatemedicationTemplateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemedicationTemplateAPIRequest $request)
    {
        $input = $request->all();

        /** @var medicationTemplate $medicationTemplate */
        $medicationTemplate = $this->medicationTemplateRepository->find($id);

        if (empty($medicationTemplate)) {
            return $this->sendError('Medication Template not found');
        }

        $medicationTemplate = $this->medicationTemplateRepository->update($input, $id);

        return $this->sendResponse($medicationTemplate->toArray(), 'medicationTemplate updated successfully');
    }

    /**
     * Remove the specified medicationTemplate from storage.
     * DELETE /medicationTemplates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var medicationTemplate $medicationTemplate */
        $medicationTemplate = $this->medicationTemplateRepository->find($id);

        if (empty($medicationTemplate)) {
            return $this->sendError('Medication Template not found');
        }

        $medicationTemplate->delete();

        return $this->sendSuccess('Medication Template deleted successfully');
    }
}
