<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecalendarAPIRequest;
use App\Http\Requests\API\UpdatecalendarAPIRequest;
use App\Models\calendar;
use App\Repositories\calendarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class calendarController
 * @package App\Http\Controllers\API
 */

class calendarAPIController extends AppBaseController
{
    /** @var  calendarRepository */
    private $calendarRepository;

    public function __construct(calendarRepository $calendarRepo)
    {
        $this->calendarRepository = $calendarRepo;
    }

    /**
     * Display a listing of the calendar.
     * GET|HEAD /calendars
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $calendars = $this->calendarRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($calendars->toArray(), 'Calendars retrieved successfully');
    }

    /**
     * Store a newly created calendar in storage.
     * POST /calendars
     *
     * @param CreatecalendarAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecalendarAPIRequest $request)
    {
        $input = $request->all();

        $calendar = $this->calendarRepository->create($input);

        return $this->sendResponse($calendar->toArray(), 'Calendar saved successfully');
    }

    /**
     * Display the specified calendar.
     * GET|HEAD /calendars/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var calendar $calendar */
        $calendar = $this->calendarRepository->find($id);

        if (empty($calendar)) {
            return $this->sendError('Calendar not found');
        }

        return $this->sendResponse($calendar->toArray(), 'Calendar retrieved successfully');
    }

    /**
     * Update the specified calendar in storage.
     * PUT/PATCH /calendars/{id}
     *
     * @param int $id
     * @param UpdatecalendarAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecalendarAPIRequest $request)
    {
        $input = $request->all();

        /** @var calendar $calendar */
        $calendar = $this->calendarRepository->find($id);

        if (empty($calendar)) {
            return $this->sendError('Calendar not found');
        }

        $calendar = $this->calendarRepository->update($input, $id);

        return $this->sendResponse($calendar->toArray(), 'calendar updated successfully');
    }

    /**
     * Remove the specified calendar from storage.
     * DELETE /calendars/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var calendar $calendar */
        $calendar = $this->calendarRepository->find($id);

        if (empty($calendar)) {
            return $this->sendError('Calendar not found');
        }

        $calendar->delete();

        return $this->sendSuccess('Calendar deleted successfully');
    }
}
