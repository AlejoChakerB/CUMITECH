<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatelabourAPIRequest;
use App\Http\Requests\API\UpdatelabourAPIRequest;
use App\Models\labour;
use App\Repositories\labourRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class labourController
 * @package App\Http\Controllers\API
 */

class labourAPIController extends AppBaseController
{
    /** @var  labourRepository */
    private $labourRepository;

    public function __construct(labourRepository $labourRepo)
    {
        $this->labourRepository = $labourRepo;
    }

    /**
     * Display a listing of the labour.
     * GET|HEAD /labours
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $labours = $this->labourRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($labours->toArray(), 'Labours retrieved successfully');
    }

    /**
     * Store a newly created labour in storage.
     * POST /labours
     *
     * @param CreatelabourAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatelabourAPIRequest $request)
    {
        $input = $request->all();

        $labour = $this->labourRepository->create($input);

        return $this->sendResponse($labour->toArray(), 'Labour saved successfully');
    }

    /**
     * Display the specified labour.
     * GET|HEAD /labours/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var labour $labour */
        $labour = $this->labourRepository->find($id);

        if (empty($labour)) {
            return $this->sendError('Labour not found');
        }

        return $this->sendResponse($labour->toArray(), 'Labour retrieved successfully');
    }

    /**
     * Update the specified labour in storage.
     * PUT/PATCH /labours/{id}
     *
     * @param int $id
     * @param UpdatelabourAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelabourAPIRequest $request)
    {
        $input = $request->all();

        /** @var labour $labour */
        $labour = $this->labourRepository->find($id);

        if (empty($labour)) {
            return $this->sendError('Labour not found');
        }

        $labour = $this->labourRepository->update($input, $id);

        return $this->sendResponse($labour->toArray(), 'labour updated successfully');
    }

    /**
     * Remove the specified labour from storage.
     * DELETE /labours/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var labour $labour */
        $labour = $this->labourRepository->find($id);

        if (empty($labour)) {
            return $this->sendError('Labour not found');
        }

        $labour->delete();

        return $this->sendSuccess('Labour deleted successfully');
    }
}
