<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatebasketAPIRequest;
use App\Http\Requests\API\UpdatebasketAPIRequest;
use App\Models\basket;
use App\Repositories\basketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class basketController
 * @package App\Http\Controllers\API
 */

class basketAPIController extends AppBaseController
{
    /** @var  basketRepository */
    private $basketRepository;

    public function __construct(basketRepository $basketRepo)
    {
        $this->basketRepository = $basketRepo;
    }

    /**
     * Display a listing of the basket.
     * GET|HEAD /baskets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $baskets = $this->basketRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($baskets->toArray(), 'Baskets retrieved successfully');
    }

    /**
     * Store a newly created basket in storage.
     * POST /baskets
     *
     * @param CreatebasketAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatebasketAPIRequest $request)
    {
        $input = $request->all();

        $basket = $this->basketRepository->create($input);

        return $this->sendResponse($basket->toArray(), 'Basket saved successfully');
    }

    /**
     * Display the specified basket.
     * GET|HEAD /baskets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var basket $basket */
        $basket = $this->basketRepository->find($id);

        if (empty($basket)) {
            return $this->sendError('Basket not found');
        }

        return $this->sendResponse($basket->toArray(), 'Basket retrieved successfully');
    }

    /**
     * Update the specified basket in storage.
     * PUT/PATCH /baskets/{id}
     *
     * @param int $id
     * @param UpdatebasketAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebasketAPIRequest $request)
    {
        $input = $request->all();

        /** @var basket $basket */
        $basket = $this->basketRepository->find($id);

        if (empty($basket)) {
            return $this->sendError('Basket not found');
        }

        $basket = $this->basketRepository->update($input, $id);

        return $this->sendResponse($basket->toArray(), 'basket updated successfully');
    }

    /**
     * Remove the specified basket from storage.
     * DELETE /baskets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var basket $basket */
        $basket = $this->basketRepository->find($id);

        if (empty($basket)) {
            return $this->sendError('Basket not found');
        }

        $basket->delete();

        return $this->sendSuccess('Basket deleted successfully');
    }
}
