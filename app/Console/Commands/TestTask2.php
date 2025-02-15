<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\CumiSystem_SQLSRV\Attendance;
use App\Models\CumiSystem_SQLSRV\Calendar;
use App\Models\Employe;

class TestTask2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:task2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'verificacion de asistencia';

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
        $today = Carbon::today()->format('Y-m-d');
        $calendars = Calendar::whereDate('start_date', '<=', $today)
                            ->whereDate('end_date', '>=', $today)
                            ->get();

        foreach ($calendars as $calendar) {
            $employes = $calendar->employe()->where('deleted_at', null)->get();
            foreach ($employes as $employe) {
                $attendance = Attendance::where('employe_id', $employe->id)
                                        ->whereDate('workday', $today)
                                        ->first();
                if (!$attendance) {
                    $attendance = new Attendance([
                        'employe_id' => $employe->id,
                        'workday' => $today,
                        'aentry_time' => '00:00:00',
                        'adeparture_time' => '00:00:00',
                    ]);
                    $attendance->save();
                    Log::info('Attendance created: ' . $attendance->id);
                }
            }
        }

        $horaActual = Carbon::now();
        if (($horaActual->greaterThanOrEqualTo(Carbon::parse('11:00:00')) && $horaActual->lessThanOrEqualTo(Carbon::parse('12:00:00')))) {
            
            $attendances = Attendance::whereDate('workday', $today)
                                    ->where('aentry_time', null)
                                    ->where('adeparture_time', null)
                                    ->get();

            foreach ($attendances as $attendance) {
                $attendance->update([
                    'aentry_time' => '00:00:00',
                    'adeparture_time' => '00:00:00',
                ]);
                Log::info('Attendance created: ' . $attendance->id);
            }
        }
    }
}