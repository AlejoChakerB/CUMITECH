<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createstand_assistanceAPIRequest;
use App\Http\Requests\API\Updatestand_assistanceAPIRequest;
use App\Models\stand_assistance;
use App\Models\user_employee;
use App\Models\presenter;
use App\Models\User;
use App\Repositories\stand_assistanceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class stand_assistanceController
 * @package App\Http\Controllers\API
 */

class stand_assistanceAPIController extends AppBaseController
{
    /** @var  stand_assistanceRepository */
    private $standAssistanceRepository;

    public function __construct(stand_assistanceRepository $standAssistanceRepo)
    {
        $this->standAssistanceRepository = $standAssistanceRepo;
    }

    /**
     * Display a listing of the stand_assistance.
     * GET|HEAD /standAssistances
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $standAssistances = $this->standAssistanceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($standAssistances->toArray(), 'Stand Assistances retrieved successfully');
    }

    /**
     * Store a newly created stand_assistance in storage.
     * POST /standAssistances
     *
     * @param Createstand_assistanceAPIRequest $request
     *
     * @return Response
     */
    public function store(Createstand_assistanceAPIRequest $request)
    {
        $input = $request->all();
        if (!$request->id) {
            return $this->sendError('Error al registrar código QR');
        }
        $userEmployee = User_employee::where('id_user', $request->idUser)->first();
        $presenter = Presenter::where('id', $request->id)->first();
        if (!$presenter) {
            return $this->sendError('Presentador no encontrado');
        }
        $input['stand'] = $presenter->stand;
        $input['state'] = 'Pendiente aprobar';
        $input['id_user_employees'] = $userEmployee->id;
        $input['id_presenter'] = $presenter->id;
        $assitance = stand_assistance::where('stand', $presenter->stand)
        ->where('id_user_employees', $userEmployee->id)
        ->first();
        if (!$assitance) {
            $standAssistance = $this->standAssistanceRepository->create($input);
            $this->storeStandAssistance($input['stand'], $input['id_user_employees'], $input['id_presenter']);
        }else {
            return $this->sendError('Asistencia registrada anteriormente');
        }

        return $this->sendResponse($standAssistance->toArray(), 'Stand Assistance saved successfully');
    }

    public function storeStandAssistance($stand, $id_user_employees, $id_presenter){
        $result = stand_assistance::where('stand', $stand)
        ->where('id_user_employees', $id_user_employees)
        ->where('id_presenter', $id_presenter)
        ->first();
        if ($result) {    
            //dd($dni_employe, $existing_sqlrv);
            $assistance_data = [
                'id' => $result->id,
                'stand' => $result->stand,
                'state' => $result->state,
                'id_user_employees' => $result->id_user_employees,
                'id_presenter' => $result->id_presenter
            ];
            
            DB::connection('cumisystem_sqlsrv')->unprepared('SET IDENTITY_INSERT stand_assistances ON');
            // Crear un nuevo registro
            \App\Models\CumiSystem_SQLSRV\stand_assistance::create($assistance_data);
            DB::connection('cumisystem_sqlsrv')->unprepared('SET IDENTITY_INSERT stand_assistances OFF');
        }
    }

    /**
     * Display the specified stand_assistance.
     * GET|HEAD /standAssistances/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var stand_assistance $standAssistance */
        $standAssistance = $this->standAssistanceRepository->find($id);

        if (empty($standAssistance)) {
            return $this->sendError('Stand Assistance not found');
        }

        return $this->sendResponse($standAssistance->toArray(), 'Stand Assistance retrieved successfully');
    }

    /**
     * Update the specified stand_assistance in storage.
     * PUT/PATCH /standAssistances/{id}
     *
     * @param int $id
     * @param Updatestand_assistanceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatestand_assistanceAPIRequest $request)
    {
        $input = $request->all();

        /** @var stand_assistance $standAssistance */
        $standAssistance = $this->standAssistanceRepository->find($id);

        if (empty($standAssistance)) {
            return $this->sendError('Stand Assistance not found');
        }

        $standAssistance = $this->standAssistanceRepository->update($input, $id);

        return $this->sendResponse($standAssistance->toArray(), 'stand_assistance updated successfully');
    }

    /**
     * Remove the specified stand_assistance from storage.
     * DELETE /standAssistances/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var stand_assistance $standAssistance */
        $standAssistance = $this->standAssistanceRepository->find($id);

        if (empty($standAssistance)) {
            return $this->sendError('Stand Assistance not found');
        }

        $standAssistance->delete();

        return $this->sendSuccess('Stand Assistance deleted successfully');
    }

    public function viewer($id)
    {
        $standAssistance = User_employee::where('id_user', $id)
        ->join('stand_assistances', 'stand_assistances.id_user_employees', '=', 'user_employees.id')
        ->get();

        if (empty($standAssistance)) {
            return $this->sendError('Stand Assistance not found');
        }

        return response()->json([
            'success' => true,
            'data' => $standAssistance
        ]);
    }
}
