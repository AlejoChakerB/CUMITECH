<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\ambulance_costController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\imaging_production_details;
use App\Models\imaging_production_supplies;
use App\Models\diferential_rates;

class imagingdetailImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $validateArray = array_map(function ($value) {
            return ($value === "") ? null : $value;
        }, $row);
        //dd($row);
        $sedation = 0;
        $contrast = 0;
        if ($row['sedacion'] == "SI") {
            $service = $row['servicio'] . " - SEDACION";
            $sedation = imaging_production_supplies::where('service', $service)->sum('unit_price');
            $anest = diferential_rates::join('procedures', 'procedures.id', '=', 'diferential_rates.id_procedure')
                ->where('procedures.code', '998702')->first();
            $sedation += $anest->value1;
        }
        if ($row['contraste'] == "SI") {
            $service = $row['servicio'] . " - CONTRASTE";
            $contrast = imaging_production_supplies::where('service', $service)->sum('unit_price');
        }
        $existing_rate = imaging_production_details::where('cups', $row['cups'])->first();
        if ($existing_rate) {
            $existing_rate->update([
                'service' => $row['servicio'],
                'category' => $row['categoria'],
                'cups' => $row['cups'],
                'duration' => $row['duracion'],
                'transcriber_cost' => $row['tecnicotranscriptor'],
                'contrast' => $contrast,
                'sedation' => $sedation
            ]);
            
            return $existing_rate;
        }else {
            //Log::info("Registrado");
            return new imaging_production_details([
                'service' => $row['servicio'],
                'category' => $row['categoria'],
                'cups' => $row['cups'],
                'duration' => $row['duracion'],
                'transcriber_cost' => $row['tecnicotranscriptor'],
                'contrast' => $contrast,
                'sedation' => $sedation
            ]);
        }
    }
}

