<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Employe;
use App\Models\Calendar;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;


class controlController extends AppBaseController
{
    public function index()
    {
        $resultados = DB::table('calendars')
            ->join('attendances', 'calendars.employe_id', '=', 'attendances.employe_id')
            ->join('employes', 'employes.id', '=', 'attendances.employe_id')
            ->select('*')
            ->whereRaw('attendances.workday BETWEEN calendars.start_date AND calendars.end_date')
            ->whereTime('attendances.aentry_time', '!=', '00:00:00')
            ->orderBy('attendances.updated_at', 'DESC')
            ->get();

        $tablaAsistencias = [];

        foreach ($resultados as $resultado) {
            $horaEntradaProgramada = Carbon::parse($resultado->entry_time);
            $horaEntradaRegistrada = Carbon::parse($resultado->aentry_time);

            $diferenciaEntrada = $horaEntradaRegistrada->diffInMinutes($horaEntradaProgramada);
            $diferenciaEntrada = $horaEntradaRegistrada->greaterThan($horaEntradaProgramada) ? $diferenciaEntrada : 0;

            $horaSalidaProgramada = Carbon::parse($resultado->departure_time);
            $horaSalidaRegistrada = Carbon::parse($resultado->adeparture_time);

            $diferenciaSalida = $horaSalidaRegistrada->diffInMinutes($horaSalidaProgramada);
            $diferenciaSalida = $horaSalidaRegistrada->lessThan($horaSalidaProgramada) ? $diferenciaSalida : 0;

            $tablaAsistencias[] = [
                'name' => $resultado->name,
                'work_position' => $resultado->work_position,
                'cost_center' => $resultado->cost_center,
                'start_date' => $resultado->start_date,
                'end_date' => $resultado->end_date,
                'entry_time' => $resultado->entry_time,
                'departure_time' => $resultado->departure_time,
                'workday' => $resultado->workday,
                'aentry_time' => $resultado->aentry_time,
                'adeparture_time' => $resultado->adeparture_time,
                'entrada_tarde' => $diferenciaEntrada,
                'salida_temprana' => $diferenciaSalida,
            ];
        }

        return view('control.index', compact('tablaAsistencias'));
    }


}
