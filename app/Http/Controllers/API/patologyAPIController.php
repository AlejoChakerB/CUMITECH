<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepatologyAPIRequest;
use App\Http\Requests\API\UpdatepatologyAPIRequest;
use App\Models\patology;
use App\Repositories\patologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class patologyController
 * @package App\Http\Controllers\API
 */

class patologyAPIController extends AppBaseController
{
    /** @var  patologyRepository */
    private $patologyRepository;

    public function __construct(patologyRepository $patologyRepo)
    {
        $this->patologyRepository = $patologyRepo;
    }

    /**
     * Display a listing of the patology.
     * GET|HEAD /patologies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $patologies = $this->patologyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($patologies->toArray(), 'Patologies retrieved successfully');
    }

    /**
     * Store a newly created patology in storage.
     * POST /patologies
     *
     * @param CreatepatologyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepatologyAPIRequest $request)
    {
        $input = $request->all();

        $patology = $this->patologyRepository->create($input);

        return $this->sendResponse($patology->toArray(), 'Patology saved successfully');
    }

    /**
     * Display the specified patology.
     * GET|HEAD /patologies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var patology $patology */
        $patology = $this->patologyRepository->find($id);

        if (empty($patology)) {
            return $this->sendError('Patology not found');
        }

        return $this->sendResponse($patology->toArray(), 'Patology retrieved successfully');
    }

    /**
     * Update the specified patology in storage.
     * PUT/PATCH /patologies/{id}
     *
     * @param int $id
     * @param UpdatepatologyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepatologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var patology $patology */
        $patology = $this->patologyRepository->find($id);

        if (empty($patology)) {
            return $this->sendError('Patology not found');
        }

        $patology = $this->patologyRepository->update($input, $id);

        return $this->sendResponse($patology->toArray(), 'patology updated successfully');
    }

    /**
     * Remove the specified patology from storage.
     * DELETE /patologies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var patology $patology */
        $patology = $this->patologyRepository->find($id);

        if (empty($patology)) {
            return $this->sendError('Patology not found');
        }

        $patology->delete();

        return $this->sendSuccess('Patology deleted successfully');
    }
}
