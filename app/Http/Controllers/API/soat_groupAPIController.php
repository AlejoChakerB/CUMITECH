<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createsoat_groupAPIRequest;
use App\Http\Requests\API\Updatesoat_groupAPIRequest;
use App\Models\soat_group;
use App\Repositories\soat_groupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class soat_groupController
 * @package App\Http\Controllers\API
 */

class soat_groupAPIController extends AppBaseController
{
    /** @var  soat_groupRepository */
    private $soatGroupRepository;

    public function __construct(soat_groupRepository $soatGroupRepo)
    {
        $this->soatGroupRepository = $soatGroupRepo;
    }

    /**
     * Display a listing of the soat_group.
     * GET|HEAD /soatGroups
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $soatGroups = $this->soatGroupRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($soatGroups->toArray(), 'Soat Groups retrieved successfully');
    }

    /**
     * Store a newly created soat_group in storage.
     * POST /soatGroups
     *
     * @param Createsoat_groupAPIRequest $request
     *
     * @return Response
     */
    public function store(Createsoat_groupAPIRequest $request)
    {
        $input = $request->all();

        $soatGroup = $this->soatGroupRepository->create($input);

        return $this->sendResponse($soatGroup->toArray(), 'Soat Group saved successfully');
    }

    /**
     * Display the specified soat_group.
     * GET|HEAD /soatGroups/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var soat_group $soatGroup */
        $soatGroup = $this->soatGroupRepository->find($id);

        if (empty($soatGroup)) {
            return $this->sendError('Soat Group not found');
        }

        return $this->sendResponse($soatGroup->toArray(), 'Soat Group retrieved successfully');
    }

    /**
     * Update the specified soat_group in storage.
     * PUT/PATCH /soatGroups/{id}
     *
     * @param int $id
     * @param Updatesoat_groupAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesoat_groupAPIRequest $request)
    {
        $input = $request->all();

        /** @var soat_group $soatGroup */
        $soatGroup = $this->soatGroupRepository->find($id);

        if (empty($soatGroup)) {
            return $this->sendError('Soat Group not found');
        }

        $soatGroup = $this->soatGroupRepository->update($input, $id);

        return $this->sendResponse($soatGroup->toArray(), 'soat_group updated successfully');
    }

    /**
     * Remove the specified soat_group from storage.
     * DELETE /soatGroups/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var soat_group $soatGroup */
        $soatGroup = $this->soatGroupRepository->find($id);

        if (empty($soatGroup)) {
            return $this->sendError('Soat Group not found');
        }

        $soatGroup->delete();

        return $this->sendSuccess('Soat Group deleted successfully');
    }
}
