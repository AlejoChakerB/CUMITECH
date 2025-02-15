<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\CumiSystem_SQLSRV\Attendance;
use App\Models\Employes;

class TestTask3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:task3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->format('Y-m-d');
        $attendances = attendance::select('attendances.*')
                ->join('employes', 'attendances.employe_id', '=', 'employes.id')
                ->where('attendances.workday', $today)
                ->whereNotNull('attendances.aentry_time')
                ->whereNotNull('attendances.adeparture_time')
                ->where(function($query) {
                    $query->where('employes.unit', '=','Administrativo')
                        ->orWhere('employes.unit', '=','Administrativo asistencial');
                })
                ->get();                
                Log::info('Found '.count($attendances));

        foreach ($attendances as $attendance) {
            
            $horaEntrada = Carbon::parse($attendance->aentry_time);
            $horaActual = now();
            if ($horaActual->greaterThanOrEqualTo(Carbon::parse('15:00:00')) && $horaActual->lessThanOrEqualTo(Carbon::parse('16:00:00'))) {
                // Verifica si es domingo o sábado
                if (Carbon::now()->isWeekend() || $horaEntrada->equalTo(Carbon::parse('00:00:00'))) {
                    Log::info('No se cumplieron las condiciones para crear la asistencia');
                    continue;
                }else {
                    // Verifica si ya existe una entrada para la tarde en la base de datos
                    $existingAttendance = Attendance::where('employe_id', $attendance->employe_id)
                    ->where('workday', $attendance->workday)
                    ->where('aentry_time', '>=', '13:00:00') // Verifica la hora de entrada
                    ->first();
    
                    if (!$existingAttendance) {
                        Log::info('Si se cumplen');
                        $newAttendance = new Attendance([
                            'employe_id' => $attendance->employe_id,
                            'workday' => $today,
                            'aentry_time' => '13:00:00',
                        ]);
                        $newAttendance->save();
                        Log::info("Attendance created for evening: " . $newAttendance->id);
                    }                         
                }
            }          
        }
    }
}