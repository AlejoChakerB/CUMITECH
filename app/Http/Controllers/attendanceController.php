<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateattendanceRequest;
use App\Http\Requests\UpdateattendanceRequest;
use App\Repositories\attendanceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\employe;
use App\Models\CumiSystem_SQLSRV\attendance;
use Carbon\Carbon;

class attendanceController extends AppBaseController
{
    /** @var attendanceRepository $attendanceRepository*/
    private $attendanceRepository;

    public function __construct(attendanceRepository $attendanceRepo)
    {
        $this->attendanceRepository = $attendanceRepo;
    }

    /**
     * Display a listing of the attendance.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_attendances');

        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $attendancesQuery = Attendance::query();

        if (!empty($search)) {
            $attendancesQuery->where('workday', 'LIKE', '%' . $search . '%')
                        ->orWhere('aentry_time', 'LIKE', '%' . $search . '%')
                        ->orWhere('adeparture_time', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('employe', function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('work_position', 'LIKE', '%' . $search . '%');
                        });
        }

        $attendances = $attendancesQuery->orderBy('workday', 'DESC')->orderBy('aentry_time', 'DESC')->paginate($perPage);

        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new attendance.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_attendances');
        $employes = Employe::orderby('name')->pluck('name', 'id');
        return view('attendances.create', compact('employes'));
    }

    /**
     * Store a newly created attendance in storage.
     *
     * @param CreateattendanceRequest $request
     *
     * @return Response
     */
    public function store(CreateattendanceRequest $request)
    {
        $this->authorize('create_attendances');
        // Obtener los datos del formulario
        $input = $request->all();
        
        // Validar la hora de registro y el campo de entrada vacío
        $entry_time = Carbon::parse($input['aentry_time']);
        $exit_time = $input['adeparture_time'];
        
        if (($entry_time->between(Carbon::parse('16:30'), Carbon::parse('18:00')))) {
            $entry_time = '01:00:00';
            $exit_time = $input['aentry_time'];
        }else {
            $entry_time = $input['aentry_time'];
        }
        
        $attendance = new Attendance();
        $attendance->workday = $input['workday'];
        $attendance->aentry_time = $entry_time;
        $attendance->adeparture_time = $exit_time;
        $attendance->employe_id = $input['employe_id'];
        
        $attendance->save();
        
        Flash::success('¡¡Asistencia guardada exitosamente!!');

        return redirect(route('attendances.index'));
    }

    /**
     * Display the specified attendance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_attendances');
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        return view('attendances.show')->with('attendance', $attendance);
    }

    /**
     * Show the form for editing the specified attendance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_attendances');
        $attendance = $this->attendanceRepository->find($id);
        $employes = Employe::pluck('name', 'id');

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        return view('attendances.edit', compact('employes'))->with('attendance', $attendance);
    }

    /**
     * Update the specified attendance in storage.
     *
     * @param int $id
     * @param UpdateattendanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateattendanceRequest $request)
    {
        $this->authorize('update_attendances');
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $attendance = $this->attendanceRepository->update($request->all(), $id);

        Flash::success('Attendance updated successfully.');

        return redirect(route('attendances.index'));
    }

    /**
     * Remove the specified attendance from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_attendances');
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $this->attendanceRepository->delete($id);

        Flash::success('Attendance deleted successfully.');

        return redirect(route('attendances.index'));
    }

    public function filter(Request $request)
    {
        $input = $request->all();
        if ($input) {
            $query = Attendance::query();
    
            // Búsqueda por nombre de empleado
            if ($request->filled('name')) {
                $query->join('employes', 'attendances.employe_id', '=', 'employes.id')
                    ->where('employes.name', 'LIKE', '%'.$request->input('name').'%');
            }
    
            // Búsqueda por fecha
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('workday', [$request->input('start_date'), $request->input('end_date')]);
            }
    
            // Ordenar por fecha de inicio ascendente
            $query->orderBy('workday', 'desc');
    
            $attendances = $query->paginate(500);
    
            return view('attendances.index')
                ->with('attendances', $attendances);  
        }else {
            return redirect(route('attendances.index'));
        }
    }
}
