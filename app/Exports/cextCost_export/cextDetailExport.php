<?php

namespace App\Exports\cextCost_export;
use App\Models\cext_details;
use App\Exports\cextCost_export\cextDetailExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class cextDetailExport implements WithMultipleSheets
{
    use Exportable;

    protected $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        if ($this->input['options'] == 'All') {
            $cextDetailCost = DB::table('cext_details AS cd')
            ->join('procedures AS pr', 'pr.code', '=', 'cd.procedure')
            ->select([
                'cd.specialty',
                DB::raw('AVG(cd.duration) AS duration'),
                DB::raw('AVG(cd.room_cost) as room_cost'),
                DB::raw('AVG(cd.medical_fees) as fees'),
                DB::raw('AVG(cd.total_cost) as total_cost')
            ])
            ->where('pr.manual_type', '256')
            ->whereNull('cd.deleted_at')
            ->groupby('cd.specialty')
            ->get();
                
            
            $detailsCext = DB::table('cext_details AS cd')
                ->join('procedures AS pr', 'pr.code', '=', 'cd.procedure')
                ->select([
                    'cd.specialty',
                    'pr.description',
                    'cd.duration',
                    'cd.room_cost',
                    'cd.medical_fees',
                    'cd.total_cost'
                ])
                ->where('pr.manual_type', '256')
                ->whereNull('cd.deleted_at')
                ->get();
        }else {
            //Armamos la consulta del costo de la cirugia
            $cextCost = cext_details::query();
            $cextCost->select([
                'cext_details.specialty',
                DB::raw('AVG(cext_details.duration) AS duration'),
                DB::raw('AVG(cext_details.room_cost) as room_cost'),
                DB::raw('AVG(cext_details.medical_fees) as fees'),
                DB::raw('AVG(cext_details.total_cost) as total_cost')
            ]);
            $cextCost->join('procedures', 'procedures.code', '=', 'cext_details.procedure');
            $cextCost->where('procedures.manual_type', '256');
            $cextCost->whereNull('cext_details.deleted_at');
            if ($this->input['specialty']) {
                $cextCost->where('cext_details.specialty', $this->input['specialty']);
            }
        
            if ($this->input['duration']) {
                $cextCost->where('duration', '>=', $this->input['duration']);
            }
            $cextCost->groupby('cext_details.specialty');
            $cextDetailCost = $cextCost->get();

            //Armamos la consulta del detalle del costo de la cirugia
            $details = cext_details::query();
            $details->join('procedures', 'procedures.code', '=', 'cext_details.procedure');
            $details->select([
                'cext_details.specialty',
                'procedures.description',
                'cext_details.duration',
                'cext_details.room_cost',
                'cext_details.medical_fees',
                'cext_details.total_cost'
            ]);
            $details->where('procedures.manual_type', '256');
            $details->whereNull('cext_details.deleted_at');
            if ($this->input['specialty']) {
                $details->where('cext_details.specialty', $this->input['specialty']);
            }
            
            if ($this->input['duration']) {
                $details->where('cext_details.duration', '>=', $this->input['duration']);
            }
            $detailsCext = $details->get();

        }
        return [
            new FirstSheetExport($cextDetailCost),
            new SecondSheetExport($detailsCext),
        ];
    }    
}
