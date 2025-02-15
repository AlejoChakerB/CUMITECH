<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecardAPIRequest;
use App\Http\Requests\API\UpdatecardAPIRequest;
use App\Models\card;
use App\Repositories\cardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cardController
 * @package App\Http\Controllers\API
 */

class cardAPIController extends AppBaseController
{
    /** @var  cardRepository */
    private $cardRepository;

    public function __construct(cardRepository $cardRepo)
    {
        $this->cardRepository = $cardRepo;
    }

    /**
     * Display a listing of the card.
     * GET|HEAD /cards
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cards = $this->cardRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cards->toArray(), 'Cards retrieved successfully');
    }

    /**
     * Store a newly created card in storage.
     * POST /cards
     *
     * @param CreatecardAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecardAPIRequest $request)
    {
        $input = $request->all();

        $card = $this->cardRepository->create($input);

        return $this->sendResponse($card->toArray(), 'Card saved successfully');
    }

    /**
     * Display the specified card.
     * GET|HEAD /cards/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var card $card */
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            return $this->sendError('Card not found');
        }

        return $this->sendResponse($card->toArray(), 'Card retrieved successfully');
    }

    /**
     * Update the specified card in storage.
     * PUT/PATCH /cards/{id}
     *
     * @param int $id
     * @param UpdatecardAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecardAPIRequest $request)
    {
        $input = $request->all();

        /** @var card $card */
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            return $this->sendError('Card not found');
        }

        $card = $this->cardRepository->update($input, $id);

        return $this->sendResponse($card->toArray(), 'card updated successfully');
    }

    /**
     * Remove the specified card from storage.
     * DELETE /cards/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var card $card */
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            return $this->sendError('Card not found');
        }

        $card->delete();

        return $this->sendSuccess('Card deleted successfully');
    }
}
