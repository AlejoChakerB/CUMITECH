<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createprocedures_homologatorAPIRequest;
use App\Http\Requests\API\Updateprocedures_homologatorAPIRequest;
use App\Models\procedures_homologator;
use App\Repositories\procedures_homologatorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class procedures_homologatorController
 * @package App\Http\Controllers\API
 */

class procedures_homologatorAPIController extends AppBaseController
{
    /** @var  procedures_homologatorRepository */
    private $proceduresHomologatorRepository;

    public function __construct(procedures_homologatorRepository $proceduresHomologatorRepo)
    {
        $this->proceduresHomologatorRepository = $proceduresHomologatorRepo;
    }

    /**
     * Display a listing of the procedures_homologator.
     * GET|HEAD /proceduresHomologators
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $proceduresHomologators = $this->proceduresHomologatorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($proceduresHomologators->toArray(), 'Procedures Homologators retrieved successfully');
    }

    /**
     * Store a newly created procedures_homologator in storage.
     * POST /proceduresHomologators
     *
     * @param Createprocedures_homologatorAPIRequest $request
     *
     * @return Response
     */
    public function store(Createprocedures_homologatorAPIRequest $request)
    {
        $input = $request->all();

        $proceduresHomologator = $this->proceduresHomologatorRepository->create($input);

        return $this->sendResponse($proceduresHomologator->toArray(), 'Procedures Homologator saved successfully');
    }

    /**
     * Display the specified procedures_homologator.
     * GET|HEAD /proceduresHomologators/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var procedures_homologator $proceduresHomologator */
        $proceduresHomologator = $this->proceduresHomologatorRepository->find($id);

        if (empty($proceduresHomologator)) {
            return $this->sendError('Procedures Homologator not found');
        }

        return $this->sendResponse($proceduresHomologator->toArray(), 'Procedures Homologator retrieved successfully');
    }

    /**
     * Update the specified procedures_homologator in storage.
     * PUT/PATCH /proceduresHomologators/{id}
     *
     * @param int $id
     * @param Updateprocedures_homologatorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateprocedures_homologatorAPIRequest $request)
    {
        $input = $request->all();

        /** @var procedures_homologator $proceduresHomologator */
        $proceduresHomologator = $this->proceduresHomologatorRepository->find($id);

        if (empty($proceduresHomologator)) {
            return $this->sendError('Procedures Homologator not found');
        }

        $proceduresHomologator = $this->proceduresHomologatorRepository->update($input, $id);

        return $this->sendResponse($proceduresHomologator->toArray(), 'procedures_homologator updated successfully');
    }

    /**
     * Remove the specified procedures_homologator from storage.
     * DELETE /proceduresHomologators/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var procedures_homologator $proceduresHomologator */
        $proceduresHomologator = $this->proceduresHomologatorRepository->find($id);

        if (empty($proceduresHomologator)) {
            return $this->sendError('Procedures Homologator not found');
        }

        $proceduresHomologator->delete();

        return $this->sendSuccess('Procedures Homologator deleted successfully');
    }
}
