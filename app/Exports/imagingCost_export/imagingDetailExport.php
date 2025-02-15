<?php

namespace App\Exports\imagingCost_export;
use App\Models\imaging_production_details;
use App\Exports\imagingCost_export\imagingDetailExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class imagingDetailExport implements WithMultipleSheets
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
            $imagingDetailCost = DB::table('imaging_production_details AS ipd')
                ->join('procedures AS pr', 'pr.code', '=', 'ipd.cups')
                ->select([
                    'ipd.service',
                    'ipd.category',
                    'ipd.cups',
                    'pr.description',
                    'ipd.duration',
                    'ipd.room_cost',
                    'ipd.transcriber_cost',
                    'ipd.doctor_cost',
                    'ipd.contrast',
                    'ipd.sedation',
                    'ipd.supplies_cost',
                    'ipd.total_cost'
                ])
                ->where('pr.manual_type', '256')
                ->whereNull('ipd.deleted_at')
                ->get();
        }else {
            
            //Armamos la consulta del detalle del costo de la cirugia
            $details = imaging_production_details::query();
            $details->join('procedures', 'procedures.code', '=', 'imaging_production_details.cups');
            $details->select([
                'imaging_production_details.service',
                'imaging_production_details.category',
                'imaging_production_details.cups',
                'procedures.description',
                'imaging_production_details.duration',
                'imaging_production_details.room_cost',
                'imaging_production_details.transcriber_cost',
                'imaging_production_details.doctor_cost',
                'imaging_production_details.contrast',
                'imaging_production_details.sedation',
                'imaging_production_details.supplies_cost',
                'imaging_production_details.total_cost'
            ]);
            
            $details->where('procedures.manual_type', '256');

            $details->whereNull('imaging_production_details.deleted_at');

            if ($this->input['service']) {
                $details->where('imaging_production_details.service', $this->input['service']);
            }
        
            if ($this->input['category']) {
                $details->where('imaging_production_details.category', $this->input['category']);
            }
            $imagingDetailCost = $details->get();
        }
        
        return [
            new SecondSheetExport($imagingDetailCost),
        ];
    }    
}
