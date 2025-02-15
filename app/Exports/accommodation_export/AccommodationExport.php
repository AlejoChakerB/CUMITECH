<?php

namespace App\Exports\accommodation_export;
use App\Models\accommodation_cost;
use App\Exports\accommodation_export\AccommodationExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AccommodationExport implements WithMultipleSheets
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
            $averagedCosts = accommodation_cost::select(
                'cost_center',
                DB::raw('AVG(permanent_overhead) AS permanent'),
                DB::raw('AVG(variable_overhead) AS variable'),
                DB::raw('AVG(administrative_twoLevel) AS administrative'),
                DB::raw('AVG(logistic_twoLevel) AS logistic'),
                DB::raw('AVG(plant_labour) AS PlantLabour'),
                DB::raw('AVG(labour) AS labour'),
                DB::raw('AVG(bedxday_cost) AS unit_cost')
            )
            ->whereNull('deleted_at')
            ->groupBy('cost_center')
            ->orderBy('cost_center')
            ->get();

            $accommodationCosts = accommodation_cost::select(
                'MONTH',
                'cost_center',
                'service',
                'permanent_overhead',
                'variable_overhead',
                'administrative_twoLevel',
                'logistic_twoLevel',
                'plant_labour',
                'labour',
                'bedxday_cost'
            )
            ->orderBy('cost_center')
            ->orderBy('service')
            ->orderByRaw("FIELD(MONTH, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')")
            ->get();
        }else {
            
            //Armamos la consulta del detalle del costo de la cirugia
            $averagedResult = accommodation_cost::query();

            $averagedResult->select(
                'cost_center',
                DB::raw('AVG(permanent_overhead) AS permanent'),
                DB::raw('AVG(variable_overhead) AS variable'),
                DB::raw('AVG(administrative_twoLevel) AS administrative'),
                DB::raw('AVG(logistic_twoLevel) AS logistic'),
                DB::raw('AVG(plant_labour) AS PlantLabour'),
                DB::raw('AVG(labour) AS labour'),
                DB::raw('AVG(bedxday_cost) AS unit_cost')
            );

            if ($this->input['cost_center']) {
                $averagedResult->where('cost_center', $this->input['cost_center']);
            }
        
            if ($this->input['service']) {
                $averagedResult->where('service', $this->input['service']);
            }

            $averagedResult->whereNull('deleted_at');
            $averagedResult->groupBy('cost_center');
            $averagedResult->orderBy('cost_center');

            $averagedCosts = $averagedResult->get();

            $accommodationResult = accommodation_cost::query();

            $accommodationResult->select(
                'MONTH',
                'cost_center',
                'service',
                'permanent_overhead',
                'variable_overhead',
                'administrative_twoLevel',
                'logistic_twoLevel',
                'plant_labour',
                'labour',
                'bedxday_cost'
            );

            if ($this->input['cost_center']) {
                $accommodationResult->where('cost_center', $this->input['cost_center']);
            }
        
            if ($this->input['service']) {
                $accommodationResult->where('service', $this->input['service']);
            }

            $accommodationResult->whereNull('deleted_at');
            $accommodationResult->orderBy('cost_center');
            $accommodationResult->orderBy('service');
            $accommodationResult->orderByRaw("FIELD(MONTH, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')");

            $accommodationCosts = $accommodationResult->get();
        }
        
        return [
            new FirstSheetExport($averagedCosts),
            new SecondSheetExport($accommodationCosts),
        ];
    }    
}
