<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatecalendarRequest;
use App\Http\Requests\UpdatecalendarRequest;
use App\Repositories\calendarRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Response;
use Carbon\Carbon;
use App\Models\employe;
use App\Models\CumiSystem_SQLSRV\calendar;

class calendarController extends AppBaseController
{
    /** @var calendarRepository $calendarRepository*/
    private $calendarRepository;

    public function __construct(calendarRepository $calendarRepo)
    {
        $this->calendarRepository = $calendarRepo;
    }

    /**
     * Display a listing of the calendar.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_calendars');

        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $calendarQuery = Calendar::query();

        if (!empty($search)) {
            $calendarQuery->where('start_date', 'LIKE', '%' . $search . '%')
                        ->orWhere('end_date', 'LIKE', '%' . $search . '%')
                        ->orWhere('entry_time', 'LIKE', '%' . $search . '%')
                        ->orWhere('departure_time', 'LIKE', '%' . $search . '%')
                        ->orWhere('floor', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('employe', function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('work_position', 'LIKE', '%' . $search . '%');
                        });
        }

        $calendars = $calendarQuery->orderBy('start_date', 'DESC')->paginate($perPage);

        return view('calendars.index', compact('calendars'));
    }

    /**
     * Show the form for creating a new calendar.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_calendars');
        $employes = Employe::orderby('name')->pluck('name', 'id');
        return view('calendars.create', compact('employes'));
    }

    /**
     * Store a newly created calendar in storage.
     *
     * @param CreatecalendarRequest $request
     *
     * @return Response
     */
    public function store(CreatecalendarRequest $request)
    {
        $this->authorize('create_calendars');
        $input = $request->all();

        $calendar = $this->calendarRepository->create($input);

        Flash::success('Calendar saved successfully.');

        return redirect(route('calendars.index'));
    }

    /**
     * Display the specified calendar.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_calendars');
        $calendar = $this->calendarRepository->find($id);

        if (empty($calendar)) {
            Flash::error('Calendar not found');

            return redirect(route('calendars.index'));
        }

        return view('calendars.show')->with('calendar', $calendar);
    }

    /**
     * Show the form for editing the specified calendar.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_calendars');
        $calendar = $this->calendarRepository->find($id);
        $employes = Employe::pluck('name', 'id');

        if (empty($calendar)) {
            Flash::error('Calendar not found');

            return redirect(route('calendars.index'));
        }

        return view('calendars.edit', compact('employes'))->with('calendar', $calendar);
    }

    /**
     * Update the specified calendar in storage.
     *
     * @param int $id
     * @param UpdatecalendarRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecalendarRequest $request)
    {
        $this->authorize('update_calendars');
        $calendar = $this->calendarRepository->find($id);

        if (empty($calendar)) {
            Flash::error('Calendar not found');

            return redirect(route('calendars.index'));
        }

        $calendar = $this->calendarRepository->update($request->all(), $id);

        Flash::success('Calendar updated successfully.');

        return redirect(route('calendars.index'));
    }

    /**
     * Remove the specified calendar from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_employes');
        $calendar = $this->calendarRepository->find($id);

        if (empty($calendar)) {
            Flash::error('Calendar not found');

            return redirect(route('calendars.index'));
        }

        $this->calendarRepository->delete($id);

        Flash::success('Calendar deleted successfully.');

        return redirect(route('calendars.index'));
    }

    public function calendarGenerator(Request $request)
    {
        // Obtener la lista de empleados
        $employees = Employe::where('unit', 'Administrativo')->get();

        // Obtener el año y mes actual
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        foreach ($employees as $employee) {
            // Obtener el primer y último día del mes actual
            $firstDayOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfDay();
            $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth()->startOfDay();
        
            $startDate = $firstDayOfMonth->copy()->startOfWeek()->setTime(8, 0, 0);
            $endDate = $startDate->copy()->endOfWeek()->subDays(2)->setTime(12, 30, 0);
            
            while ($startDate->lte($lastDayOfMonth)) {
                // Buscar un calendario existente para la fecha y empleado actual
                $existingCalendar = Calendar::where('start_date', $startDate->toDateString())
                    ->where('end_date', $endDate->toDateString())
                    ->where('employe_id', $employee->id)
                    ->where('entry_time', $startDate->format('H:i:s'))
                    ->where('departure_time', $endDate->format('H:i:s'))
                    ->first();
                    
                if (!$existingCalendar) {
                    // Crear el registro en la tabla 'calendars' solo si no existe
                    Calendar::create([
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'entry_time' => $startDate->format('H:i:s'),
                        'departure_time' => $endDate->format('H:i:s'),
                        'floor' => $employee->cost_center,
                        'employe_id' => $employee->id,
                    ]);
                }
                $startDate->addWeek();
                $endDate = $startDate->copy()->endOfWeek()->subDays(2)->setTime(12, 30, 0);
            }
        }
        $this->calendarGeneratorAf(new Request());
        $this->calendarGeneratorAsis(new Request());
        $this->calendarGeneratorAsisAf(new Request());
        $this->calendarGeneratorSaturday(new Request());
        $this->calendarGeneratorAsiSaturday(new Request());
        return redirect(route('calendars.index'));
    }

    public function calendarGeneratorAf(Request $request)
    {
        // Obtener la lista de empleados
        $employees = Employe::where('unit', 'Administrativo')->get();
    
        // Obtener el año y mes actual
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
    
        foreach ($employees as $employee) {
            // Obtener el primer y último día del mes actual
            $firstDayOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfDay();
            $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth()->startOfDay();
    
            $startDateAf = $firstDayOfMonth->copy()->startOfWeek()->setTime(13, 30, 0);
            $endDateAf = $startDateAf->copy()->endOfWeek()->subDays(2)->setTime(17, 0, 0);
                
            while ($startDateAf->lte($lastDayOfMonth)) {
                // Buscar un calendario existente para la fecha y empleado actual
                $existingCalendar = Calendar::where('start_date', $startDateAf->toDateString())
                    ->where('end_date', $endDateAf->toDateString())
                    ->where('employe_id', $employee->id)
                    ->where('entry_time', $startDateAf->format('H:i:s'))
                    ->where('departure_time', $endDateAf->format('H:i:s'))
                    ->first();
        
                    if (!$existingCalendar) {
                        Calendar::create([
                            'start_date' => $startDateAf,
                            'end_date' => $endDateAf,
                            'entry_time' => $startDateAf->format('H:i:s'),
                            'departure_time' => $endDateAf->format('H:i:s'),
                            'floor' => $employee->cost_center,
                            'employe_id' => $employee->id,
                        ]);
                    }
            
                $startDateAf->addWeek();
                $endDateAf = $startDateAf->copy()->endOfWeek()->subDays(2)->setTime(17, 0, 0);
            }
        }
    }
    
    public function calendarGeneratorAsis(Request $request)
    {
        // Obtener la lista de empleados
        $employees = Employe::where('unit', 'Administrativo asistencial')->get();
        
        // Obtener el año y mes actual
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        
        foreach ($employees as $employee) {
            // Obtener el primer y último día del mes actual
            $firstDayOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfDay();
            $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth()->startOfDay();
            
            $startDate = $firstDayOfMonth->copy()->startOfWeek()->setTime(7, 0, 0);
            $endDate = $startDate->copy()->endOfWeek()->subDays(2)->setTime(12, 0, 0);
            
            while ($startDate->lte($lastDayOfMonth)) {
                // Buscar un calendario existente para la fecha y empleado actual
                $existingCalendar = Calendar::where('start_date', $startDate->toDateString())
                ->where('end_date', $endDate->toDateString())
                ->where('employe_id', $employee->id)
                ->where('entry_time', $startDate->format('H:i:s'))
                ->where('departure_time', $endDate->format('H:i:s'))
                ->first();
                    
                if (!$existingCalendar) {
                    // Crear el registro en la tabla 'calendars' solo si no existe
                    Calendar::create([
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'entry_time' => $startDate->format('H:i:s'),
                        'departure_time' => $endDate->format('H:i:s'),
                        'floor' => $employee->cost_center,
                        'employe_id' => $employee->id,
                    ]);
                }
                    
                $startDate->addWeek();
                $endDate = $startDate->copy()->endOfWeek()->subDays(2)->setTime(12, 0, 0);
            }
        }
    }
        
    public function calendarGeneratorAsisAf(Request $request)
    {
        // Obtener la lista de empleados
        $employees = Employe::where('unit', 'Administrativo asistencial')->get();
    
        // Obtener el año y mes actual
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
    
        foreach ($employees as $employee) {
            // Obtener el primer y último día del mes actual
            $firstDayOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfDay();
            $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth()->startOfDay();
    
            $startDateAf = $firstDayOfMonth->copy()->startOfWeek()->setTime(14, 0, 0);
            $endDateAf = $startDateAf->copy()->endOfWeek()->subDays(2)->setTime(17, 0, 0);
                
            while ($startDateAf->lte($lastDayOfMonth)) {
                // Buscar un calendario existente para la fecha y empleado actual
                $existingCalendar = Calendar::where('start_date', $startDateAf->toDateString())
                    ->where('end_date', $endDateAf->toDateString())
                    ->where('employe_id', $employee->id)
                    ->where('entry_time', $startDateAf->format('H:i:s'))
                    ->where('departure_time', $endDateAf->format('H:i:s'))
                    ->first();
        
                    if (!$existingCalendar) {
                        Calendar::create([
                            'start_date' => $startDateAf,
                            'end_date' => $endDateAf,
                            'entry_time' => $startDateAf->format('H:i:s'),
                            'departure_time' => $endDateAf->format('H:i:s'),
                            'floor' => $employee->cost_center,
                            'employe_id' => $employee->id,
                        ]);
                    }
            
                $startDateAf->addWeek();
                $endDateAf = $startDateAf->copy()->endOfWeek()->subDays(2)->setTime(17, 0, 0);
            }
        }
    }
        
    public function calendarGeneratorSaturday(Request $request)
    {
        // Obtener la lista de empleados
        $employees = Employe::where('unit', 'Administrativo')->get();
            
        // Obtener el año y mes actual
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        foreach ($employees as $employee) {
            // Obtener el primer y último día del mes actual
            $firstDayOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfDay();
            $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth()->startOfDay();

            // Buscar el primer sábado del mes
            $firstSaturday = $firstDayOfMonth->copy()->modify('first saturday');

            // Verificar si el primer sábado cae dentro del mes actual
            if ($firstSaturday->lte($lastDayOfMonth)) {
                $date = $firstSaturday;
                while ($date->lte($lastDayOfMonth)) {
                    // Buscar un calendario existente para la fecha y empleado actual
                    $existingCalendar = Calendar::where('start_date', $date->toDateString())
                        ->where('end_date', $date->toDateString())
                        ->where('employe_id', $employee->id)
                        ->where('entry_time', '08:00:00')
                        ->where('departure_time', '13:00:00')
                        ->first();

                    if (!$existingCalendar) {
                        // Crear el registro en la tabla 'calendars' solo si no existe
                        Calendar::create([
                            'start_date' => $date,
                            'end_date' => $date,
                            'entry_time' => '08:00:00',
                            'departure_time' => '13:00:00',
                            'floor' => $employee->cost_center,
                            'employe_id' => $employee->id,
                        ]);
                    }

                    $date->addWeek(); // Avanzar al siguiente sábado
                }
            }
        }
    }
    
    public function calendarGeneratorAsiSaturday(Request $request)
    {
        // Obtener la lista de empleados
        $employees = Employe::where('unit', 'Administrativo asistencial')->get();

        // Obtener el año y mes actual
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        foreach ($employees as $employee) {
            // Obtener el primer y último día del mes actual
            $firstDayOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfDay();
            $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth()->startOfDay();

            // Buscar el primer sábado del mes
            $firstSaturday = $firstDayOfMonth->copy()->modify('first saturday');

            // Verificar si el primer sábado cae dentro del mes actual
            if ($firstSaturday->lte($lastDayOfMonth)) {
                $date = $firstSaturday;
                while ($date->lte($lastDayOfMonth)) {
                    // Buscar un calendario existente para la fecha y empleado actual
                    $existingCalendar = Calendar::where('start_date', $date->toDateString())
                        ->where('end_date', $date->toDateString())
                        ->where('employe_id', $employee->id)
                        ->where('entry_time', '07:00:00')
                        ->where('departure_time', '12:00:00')
                        ->first();

                    if (!$existingCalendar) {
                        // Crear el registro en la tabla 'calendars' solo si no existe
                        Calendar::create([
                            'start_date' => $date,
                            'end_date' => $date,
                            'entry_time' => '07:00:00',
                            'departure_time' => '12:00:00',
                            'floor' => $employee->cost_center,
                            'employe_id' => $employee->id,
                        ]);
                    }

                    $date->addWeek(); // Avanzar al siguiente sábado
                }
            }
        }
    }
 
}
