<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\cumiLab_rate;
use App\Models\procedures;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CumilabImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        
        $validateArray = array_map(function ($value) {
            return ($value === "") ? null : $value;
        }, $row);
        //dd($row);
        //Log::info($row);
        //Procedimiento correspondiente
        $observation = "";
        $procedures = Procedures::where('code', (string) $row['cups'])->first();
        if (!$procedures) {
            $procedures = Procedures::where('cups', (string) $row['cups'])->first();
            if (!$procedures) {
                $procedures = Procedures::where('code', '0')
                ->Where('cups', '0')->first();
                $observation = $row['cups'];
            }
        }
        //dd($procedures);
        $existing_rate = CumiLab_rate::where('cups', (string) $procedures->code)
        ->where('observation', $observation)->first();

        if ($existing_rate) {
            $fields = $this->prepareFields($row, $observation, $procedures);
            $existing_rate->update($fields);
            return $existing_rate;
        } else {
            $fields = $this->prepareFields($row, $observation, $procedures);
            return new CumiLab_rate($fields);
        }
    }

    public function prepareFields($row, $observation, $procedures) {
        $baseFields = [
            'period' => $row['periodo'],
            'cumilab_rate' => (float)$row['tarifa_cumilab'],
            'mutual_rate' => (float)$row['tarifa_mutual'],
            'observation' => $observation,
            'cups' => $procedures->code
        ];
    
        $monthMapping = [
            'enero' => 'january',
            'febrero' => 'february',
            'marzo' => 'march',
            'abril' => 'april',
            'mayo' => 'may',
            'junio' => 'june',
            'julio' => 'july',
            'agosto' => 'august',
            'septiembre' => 'september',
            'octubre' => 'october',
            'noviembre' => 'november',
            'diciembre' => 'december'
        ];
    
        foreach ($monthMapping as $spanishMonth => $englishMonth) {
            if (isset($row[$spanishMonth]) && $row[$spanishMonth] !== null) {
                $baseFields[$englishMonth] = (float)$row[$spanishMonth];
            }
        }
    
        return $baseFields;
    }
}

