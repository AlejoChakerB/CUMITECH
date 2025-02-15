<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Employe;
use App\Models\Calendar;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceTimeController extends Controller
{
    public function attendanceNot() {
        $attendances = Attendance::whereDate('workday', now())
        ->where('aentry_time', '00:00:00')
        ->where('adeparture_time', '00:00:00')
        ->orderBy('workday', 'DESC')
        ->get();

        return view('attendanceReports.noAttendance', compact('attendances'));
    }
}
