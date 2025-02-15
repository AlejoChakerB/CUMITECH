<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\CumiSystem_SQLSRV\Attendance;
use App\Models\Employes;

class TestTask4 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:task4';

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
                ->where(function($query) {
                    $query->whereNull('attendances.adeparture_time')
                        ->orWhere('attendances.adeparture_time', '');
                })
                ->where('attendances.aentry_time', '<', '12:00:00')
                ->where('employes.unit', '=','Asistencial')
                ->get();                
                Log::info('Found '.count($attendances).' attendances for today and care.');

        foreach ($attendances as $attendance) {
            
            $horaEntrada = Carbon::parse($attendance->aentry_time);
            $horaActual = now();
            if ($horaActual->greaterThanOrEqualTo(Carbon::parse('22:00:00')) && $horaActual->lessThanOrEqualTo(Carbon::parse('23:00:00'))) {
                $attendance->update(['adeparture_time' => '00:00:00']);
                    $attendance->save();
                    Log::info("Attendance updated care: " . $attendance->id);
            }
        }
    }
}
