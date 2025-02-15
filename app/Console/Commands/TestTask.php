<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\CumiSystem_SQLSRV\Attendance;
use App\Models\Employes;

class TestTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update automatico de adeparture_time';

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
                ->where(function($query) {
                    $query->whereNull('attendances.adeparture_time')
                        ->orWhere('attendances.adeparture_time', '');
                })
                ->whereNotNull('attendances.aentry_time')
                ->where(function($query) {
                    $query->where('employes.unit', '=','Administrativo')
                        ->orWhere('employes.unit', '=','Administrativo asistencial');
                })
                ->get();                
                Log::info('Found '.count($attendances).' attendances for today and administrative.');

        foreach ($attendances as $attendance) {
            
            $horaEntrada = Carbon::parse($attendance->aentry_time);
            $horaActual = now();
            if ($horaActual->greaterThanOrEqualTo(Carbon::parse('13:00:00')) && $horaActual->lessThanOrEqualTo(Carbon::parse('13:30:00'))) {
                // Verifica si es domingo o sábado
                if (Carbon::now()->isWeekend()) {
                    Log::info('No se cumplieron las condiciones para crear la salida');
                    continue;
                }else {
                    $attendance->update(['adeparture_time' => '00:00:00']);
                    $attendance->save();
                    Log::info("Attendance updated morning: " . $attendance->id);
                }
            }elseif ($horaActual->greaterThanOrEqualTo(Carbon::parse('22:00:00')) && $horaActual->lessThanOrEqualTo(Carbon::parse('22:30:00'))) {
                $attendance->update(['adeparture_time' => '00:00:00']);
                $attendance->save();
                Log::info("Attendance updated affternon: " . $attendance->id);
            }
        }
    }
}
