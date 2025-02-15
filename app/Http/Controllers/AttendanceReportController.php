<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Employe;
use App\Models\Calendar;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceReportController extends Controller
{
    public function attendanceToday() {
        $attendances = Attendance::whereDate('workday', now())
        ->where('aentry_time', '<>', '00:00:00')
        ->orderBy('workday', 'DESC')
        ->orderBy('aentry_time', 'DESC')
        ->get();

        return view('attendanceReports.table', compact('attendances'));
    }

    public function getWorkingAndFinished()
    {
        $working = Attendance::whereDate('workday', now())
            ->whereNotNull('aentry_time')
            ->whereNull('adeparture_time')
            ->orderBy('workday', 'DESC')
            ->orderBy('aentry_time', 'DESC')
            ->get();

        $finished = Attendance::whereDate('workday', now())
            ->where('aentry_time', '<>', '00:00:00')
            ->where('adeparture_time', '<>', '00:00:00')
            ->get();

            return view('attendanceReports.working', compact('working'))
            ->with('finished', $finished);
    }

    public function getFinished()
    {
        $attendances = Attendance::whereDate('workday', now())
            ->where('aentry_time', '<>', '00:00:00')
            ->where('adeparture_time', '<>', '00:00:00')
            ->orderBy('workday', 'DESC')
            ->orderBy('adeparture_time', 'DESC')
            ->get();

        return view('attendanceReports.finished', compact('attendances'));
    }

    public function logistics(Request $request) {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $attendancesQuery = Attendance::query();
        
        if (!empty($search)) {
            $attendancesQuery->whereHas('employe', function ($query) {
                $query->whereIn('work_position', ['PROFESIONAL LOGISTICA', 'Auxiliar de servicios generales', 'Auxiliar de ropa intrahospitalaria']);
            })
            ->where(function ($query) use ($search) {
                $query->where('workday', 'LIKE', '%' . $search . '%')
                    ->orWhere('aentry_time', 'LIKE', '%' . $search . '%')
                    ->orWhere('adeparture_time', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('employe', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('work_position', 'LIKE', '%' . $search . '%');
                    });
            });                       
        }else {
            $attendancesQuery->WhereHas('employe', function ($query) {
                            $query->where('employes.work_position', 'PROFESIONAL LOGISTICA')
                            ->OrWhere('employes.work_position', 'Auxiliar de servicios generales')
                            ->OrWhere('employes.work_position', 'Auxiliar de ropa intrahospitalaria');
                        });
        }

        $attendances = $attendancesQuery->orderBy('workday', 'DESC')
        ->orderBy('aentry_time', 'DESC')
        ->paginate($perPage);
        
        return view('attendanceReports.logistic', compact('attendances'));
    }

    public function filterLogistic(Request $request)
    {
        $input = $request->all();
        if ($input) {
            $query = Attendance::query();
    
            // Búsqueda por nombre de empleado
            if ($request->filled('name')) {
                $query->join('employes', 'attendances.employe_id', '=', 'employes.id')
                ->where('employes.name', 'LIKE', '%'.$request->input('name').'%')
                ->whereIn('employes.work_position', ['PROFESIONAL LOGISTICA', 'Auxiliar de servicios generales', 'Auxiliar de ropa intrahospitalaria'])
                ->orderBy('workday', 'DESC');
            }
    
            // Búsqueda por fecha
            //if ($request->filled('start_date') && $request->filled('end_date')) {
                //$query->whereBetween('workday', [$request->input('start_date'), $request->input('end_date')]);
            //}
    
            // Ordenar por fecha de inicio ascendente
            $query->orderBy('workday', 'desc');
    
            $attendances = $query->paginate(500);
    
            return view('attendanceReports.logistic')
                ->with('attendances', $attendances);  
        }else {
            return redirect(route('attendanceReports.logistic'));
        }
    }

    
}
