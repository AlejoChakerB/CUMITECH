<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\ambulance_costController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\patology;

class patologyImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $validateArray = array_map(function ($value) {
            return ($value === "") ? null : $value;
        }, $row);
        //dd($row);
        $existing_rate = patology::where('service', $row['servicio'])
        ->where('cups', $row['cups'])->first();
        if ($existing_rate) {
            $existing_rate->update([
                'service' => $row['servicio'],
                'cups' => $row['cups'],
                'description' => $row['descripcion'],
                'value' => $row['valor']
            ]);
            
            return $existing_rate;
        }else {
            //Log::info("Registrado");
            return new patology([
                'service' => $row['servicio'],
                'cups' => $row['cups'],
                'description' => $row['descripcion'],
                'value' => $row['valor']
            ]);
        }
    }
}

