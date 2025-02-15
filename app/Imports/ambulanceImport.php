<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\ambulance_costController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\ambulance_cost;

class ambulanceImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $validateArray = array_map(function ($value) {
            return ($value === "") ? null : $value;
        }, $row);
        //dd($row);
        $recharg = $row['valor'] * 0.25; 
        $existing_rate = ambulance_cost::where('cups', $row['cups'])->first();
        if ($existing_rate) {
            $existing_rate->update([
                'cups' => $row['cups'],
                'name' => $row['nombre'],
                'value' => $row['valor'],
                'recharge' => $recharg
            ]);
            
            return $existing_rate;
        }else {
            //Log::info("Registrado");
            return new ambulance_cost([
                'cups' => $row['cups'],
                'name' => $row['nombre'],
                'value' => $row['valor'],
                'recharge' => $recharg
            ]);
        }
    }
}

