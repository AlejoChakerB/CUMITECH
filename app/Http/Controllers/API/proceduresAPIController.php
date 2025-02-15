<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateproceduresAPIRequest;
use App\Http\Requests\API\UpdateproceduresAPIRequest;
use App\Models\procedures;
use App\Repositories\proceduresRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class proceduresController
 * @package App\Http\Controllers\API
 */

class proceduresAPIController extends AppBaseController
{
    /** @var  proceduresRepository */
    private $proceduresRepository;

    public function __construct(proceduresRepository $proceduresRepo)
    {
        $this->proceduresRepository = $proceduresRepo;
    }

    /**
     * Display a listing of the procedures.
     * GET|HEAD /procedures
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $procedures = $this->proceduresRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($procedures->toArray(), 'Procedures retrieved successfully');
    }

    /**
     * Store a newly created procedures in storage.
     * POST /procedures
     *
     * @param CreateproceduresAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateproceduresAPIRequest $request)
    {
        $input = $request->all();

        $procedures = $this->proceduresRepository->create($input);

        return $this->sendResponse($procedures->toArray(), 'Procedures saved successfully');
    }

    /**
     * Display the specified procedures.
     * GET|HEAD /procedures/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var procedures $procedures */
        $procedures = $this->proceduresRepository->find($id);

        if (empty($procedures)) {
            return $this->sendError('Procedures not found');
        }

        return $this->sendResponse($procedures->toArray(), 'Procedures retrieved successfully');
    }

    /**
     * Update the specified procedures in storage.
     * PUT/PATCH /procedures/{id}
     *
     * @param int $id
     * @param UpdateproceduresAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproceduresAPIRequest $request)
    {
        $input = $request->all();

        /** @var procedures $procedures */
        $procedures = $this->proceduresRepository->find($id);

        if (empty($procedures)) {
            return $this->sendError('Procedures not found');
        }

        $procedures = $this->proceduresRepository->update($input, $id);

        return $this->sendResponse($procedures->toArray(), 'procedures updated successfully');
    }

    /**
     * Remove the specified procedures from storage.
     * DELETE /procedures/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var procedures $procedures */
        $procedures = $this->proceduresRepository->find($id);

        if (empty($procedures)) {
            return $this->sendError('Procedures not found');
        }

        $procedures->delete();

        return $this->sendSuccess('Procedures deleted successfully');
    }
}
