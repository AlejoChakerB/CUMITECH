<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepresenterAPIRequest;
use App\Http\Requests\API\UpdatepresenterAPIRequest;
use App\Models\presenter;
use App\Models\stand_assistance;
use App\Models\user_employee;
use App\Repositories\presenterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Response;

/**
 * Class presenterController
 * @package App\Http\Controllers\API
 */

class presenterAPIController extends AppBaseController
{
    /** @var  presenterRepository */
    private $presenterRepository;

    public function __construct(presenterRepository $presenterRepo)
    {
        $this->presenterRepository = $presenterRepo;
    }

    /**
     * Display a listing of the presenter.
     * GET|HEAD /presenters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $presenters = $this->presenterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($presenters->toArray(), 'Presenters retrieved successfully');
    }

    /**
     * Store a newly created presenter in storage.
     * POST /presenters
     *
     * @param CreatepresenterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepresenterAPIRequest $request)
    {
        $input = $request->all();

        $presenter = $this->presenterRepository->create($input);

        return $this->sendResponse($presenter->toArray(), 'Presenter saved successfully');
    }

    /**
     * Display the specified presenter.
     * GET|HEAD /presenters/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var presenter $presenter */
        $presenter = $this->presenterRepository->find($id);

        if (empty($presenter)) {
            return $this->sendError('Presenter not found');
        }

        return $this->sendResponse($presenter->toArray(), 'Presenter retrieved successfully');
    }

    /**
     * Update the specified presenter in storage.
     * PUT/PATCH /presenters/{id}
     *
     * @param int $id
     * @param UpdatepresenterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepresenterAPIRequest $request)
    {
        $input = $request->all();

        /** @var presenter $presenter */
        $presenter = $this->presenterRepository->find($id);

        if (empty($presenter)) {
            return $this->sendError('Presenter not found');
        }

        $presenter = $this->presenterRepository->update($input, $id);

        return $this->sendResponse($presenter->toArray(), 'presenter updated successfully');
    }

    /**
     * Remove the specified presenter from storage.
     * DELETE /presenters/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var presenter $presenter */
        $presenter = $this->presenterRepository->find($id);

        if (empty($presenter)) {
            return $this->sendError('Presenter not found');
        }

        $presenter->delete();

        return $this->sendSuccess('Presenter deleted successfully');
    }

    public function showPending($userid)
    {
        $present = User_employee::where('id_user', $userid)
        ->join('presenters', 'presenters.id_users_employees', '=', 'user_employees.id')
        ->select('user_employees.id_user', 'user_employees.id_employees', 'presenters.id', 'presenters.stand', 'presenters.id_users_employees')
        ->first();

        $pending = Stand_assistance::where('id_presenter', $present->id)
        ->join('user_employees', 'user_employees.id', '=', 'stand_assistances.id_user_employees')
        ->join('employes', 'employes.id', '=', 'user_employees.id_employees')
        ->select('stand_assistances.id', 'stand_assistances.stand', 'stand_assistances.state', 'stand_assistances.approved_date', 'stand_assistances.created_at', 'employes.dni', 'employes.name', 'employes.work_position', 'employes.cost_center', 'employes.service')
        ->whereNull('approved_date')
        ->get();

        return $this->sendResponse($pending->toArray(), 'Pending retrieved successfully');
    }

    public function approveAttendance(Request $request)
    {
        $input = $request->input('selectedIds');
        $now = Carbon::now();
        $updatedCount = Stand_assistance::whereIn('id', $input)
        ->update([
            'state' => 'Aprobado',
            'approved_date' => now()
        ]);
        $this->approveSqlsrv($input);
        return response()->json(['message' => 'Asistencias aprobadas con éxito']);

    }

    public function approveSqlsrv($ids){
        $sqlsrvModel = \App\Models\CumiSystem_SQLSRV\stand_assistance::class;
        // Optimización: Actualización en lote en lugar de uno por uno
        return $sqlsrvModel::whereIn('id', $ids)
            ->update([
                'state' => 'Aprobado',
                'approved_date' => now()
            ]);
    }
    public function showPresenter($userid)
    {
        $present = User_employee::where('id_user', $userid)
        ->join('employes', 'employes.id', '=', 'user_employees.id_employees')
        ->join('presenters', 'presenters.id_users_employees', '=', 'user_employees.id')
        ->select('presenters.qr_code','presenters.stand', 'employes.name', 'employes.work_position')
        ->first();

        return $this->sendResponse($present->toArray(), 'Pending retrieved successfully');
    }

    public function showApproved($userid)
    {
        $present = User_employee::where('id_user', $userid)
        ->join('presenters', 'presenters.id_users_employees', '=', 'user_employees.id')
        ->select('user_employees.id_user', 'user_employees.id_employees', 'presenters.id', 'presenters.stand', 'presenters.id_users_employees')
        ->first();

        $approved = Stand_assistance::where('id_presenter', $present->id)
        ->join('user_employees', 'user_employees.id', '=', 'stand_assistances.id_user_employees')
        ->join('employes', 'employes.id', '=', 'user_employees.id_employees')
        ->select('stand_assistances.id', 'stand_assistances.stand', 'stand_assistances.state', 'stand_assistances.approved_date', 'stand_assistances.created_at', 'employes.dni', 'employes.name', 'employes.work_position', 'employes.cost_center', 'employes.service')
        ->whereNotNull('approved_date')
        ->get();

        return $this->sendResponse($approved->toArray(), 'Pending retrieved successfully');
    }
}
