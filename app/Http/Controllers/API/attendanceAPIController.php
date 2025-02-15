<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateattendanceAPIRequest;
use App\Http\Requests\API\UpdateattendanceAPIRequest;
use App\Models\attendance;
use App\Repositories\attendanceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Carbon\Carbon;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class attendanceController
 * @package App\Http\Controllers\API
 */

class attendanceAPIController extends AppBaseController
{
    /** @var  attendanceRepository */
    private $attendanceRepository;

    public function __construct(attendanceRepository $attendanceRepo)
    {
        $this->attendanceRepository = $attendanceRepo;
    }

    /**
     * Display a listing of the attendance.
     * GET|HEAD /attendances
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $attendances = $this->attendanceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($attendances->toArray(), 'Attendances retrieved successfully');
    }

    /**
     * Store a newly created attendance in storage.
     * POST /attendances
     *
     * @param CreateattendanceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateattendanceAPIRequest $request)
    {
        $input = $request->all();

        $attendance = $this->attendanceRepository->create($input);

        return $this->sendResponse($attendance->toArray(), 'Attendance saved successfully');
    }

    public function updateEntrance(CreateattendanceAPIRequest $request)
    {
        $input = $request->all();
        
        if ($input['action'] === 128) {
            $lastAttendance = attendance::where('employe_id', $input['employe_id'])
                ->whereDate('workday', $input['workday'])
                ->orderBy('id', 'desc')
                ->first();
        
            // Verificar si el registro ya existe
            $attendanceExists = attendance::where('workday', $input['workday'])
            ->where('aentry_time', $input['aentry_time'])
            ->where('employe_id', $input['employe_id'])
            ->exists();

            if ($attendanceExists) {
                return $this->sendError('Este usuario ya registro una entrada.');
            } else {
                if (!$lastAttendance) {
                    // No hay registros anteriores, permitimos la entrada
                    $attendance = $this->attendanceRepository->create($input);
                } else if ($lastAttendance->adeparture_time) {
                    // El último registro ya tiene salida, permitimos la entrada
                    $attendance = $this->attendanceRepository->create($input);
                } else {
                    // El último registro no tiene salida, no permitimos la entrada
                    return $this->sendError('Este usuario ya registró una entrada y no ha generado una salida.');
                }
            }
        }else {
            if ($input['action'] === 129) {
                $entryDate = $input['workday'];
                $entryTime = $input['aentry_time'];
                
                $findAttendanceByDay = attendance::whereDate('workday', $entryDate)
                    ->where('employe_id', $input['employe_id'])
                    ->whereNull('adeparture_time')
                    ->orderBy('workday', 'desc')
                    ->first();
            
                if ($findAttendanceByDay && $findAttendanceByDay['aentry_time'] <= $entryTime) {
                    $findAttendanceByDay->adeparture_time = $entryTime;
                    $findAttendanceByDay->save();
                    return $this->sendResponse($findAttendanceByDay->toArray(), 'Asistencia actualizada');
                }
            
                if (!$findAttendanceByDay) {
                    $findAttendanceByPreviousDay = attendance::where('employe_id', $input['employe_id'])
                        ->where(function ($query) use ($entryDate, $entryTime) {
                            $query->where(function ($subquery) use ($entryDate, $entryTime) {
                                $subquery->whereDate('workday', Carbon::parse($entryDate)->subDay())
                                    ->whereTime('aentry_time', '>', $entryTime);
                            })->orWhere(function ($subquery) use ($entryDate, $entryTime) {
                                $subquery->whereDate('workday', Carbon::parse($entryDate)->subDay());
                            });
                        })
                        ->orderBy('workday', 'desc')
                        ->first();
            
                    if (!$findAttendanceByPreviousDay) {
                        return $this->sendError('No se encontró ninguna entrada para el usuario en la fecha especificada.');
                    }
            
                    if (!empty($findAttendanceByPreviousDay['adeparture_time'])) {
                        return $this->sendError('Este usuario ya registró una salida.');
                    }
            
                    $findAttendanceByPreviousDay->adeparture_time = $entryTime;
                    $findAttendanceByPreviousDay->save();
                    return $this->sendResponse($findAttendanceByPreviousDay->toArray(), 'Asistencia actualizada');
                }
            
                $findAttendance = attendance::where('employe_id', $input['employe_id'])
                    ->where(function ($query) use ($entryDate, $entryTime) {
                        $query->where(function ($subquery) use ($entryDate, $entryTime) {
                            $subquery->whereDate('workday', $entryDate)
                                ->whereTime('aentry_time', '>', $entryTime);
                        })->orWhere(function ($subquery) use ($entryDate, $entryTime) {
                            $subquery->whereDate('workday', '>', $entryDate);
                        });
                    })
                    ->orderBy('workday', 'desc')
                    ->first();
            
                if (empty($findAttendance)) {
                    return $this->sendError('Attendance not found');
                }
            
                if (!empty($findAttendance['adeparture_time'])) {
                    return $this->sendError('Este usuario ya registró una salida.');
                }
            
                $findAttendance['adeparture_time'] = $entryTime;
                $findAttendance->save();
                return $this->sendResponse($findAttendance->toArray(), 'Attendance saved successfully');
            }
            
            
        }

        return $this->sendResponse($attendance->toArray(), 'Attendance saved successfully');
    }
    /**
     * Display the specified attendance.
     * GET|HEAD /attendances/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var attendance $attendance */
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            return $this->sendError('Attendance not found');
        }

        return $this->sendResponse($attendance->toArray(), 'Attendance retrieved successfully');
    }

    /**
     * Update the specified attendance in storage.
     * PUT/PATCH /attendances/{id}
     *
     * @param int $id
     * @param UpdateattendanceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateattendanceAPIRequest $request)
    {
        $input = $request->all();

        /** @var attendance $attendance */
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            return $this->sendError('Attendance not found');
        }

        $attendance = $this->attendanceRepository->update($input, $id);

        return $this->sendResponse($attendance->toArray(), 'attendance updated successfully');
    }

    /**
     * Remove the specified attendance from storage.
     * DELETE /attendances/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var attendance $attendance */
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            return $this->sendError('Attendance not found');
        }

        $attendance->delete();

        return $this->sendSuccess('Attendance deleted successfully');
    }
}
