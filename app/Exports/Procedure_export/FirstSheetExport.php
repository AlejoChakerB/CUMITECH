<?php

namespace App\Exports\Procedure_export;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Collection;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FirstSheetExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle, WithColumnFormatting

{
    protected $input;

    public function __construct(Collection  $input)
    {
        $this->input = $input;
    }

    public function collection()
    {
        return new Collection($this->input);
    }

    public function headings(): array
    {
        return [
            'Contrato',
            'Paciente',
            'Estudio',
            'Código acto quirurgico',
            'Código facturacion',
            'Fecha cirugia',
            'Hora inicial',
            'Hora final',
            'Tiempo',
            'Especialidad',
            'Médico',
            'Médico 2',
            'Anestesiologo',
            'Sala de operaciones',
            'CUPS',
            'Descripcion',
            'Código paquete',
            'Valor facturado',
            '% Participacion',
            '% Liquidación',
            'Honorario médico',
            'Honorario médico 2',
            'Honorario anestesiologo',
            'Costo sala',
            'Canasta',
            'Consumibles',
            'Equipos rentados',
            'Gases',
            'Distribucion paquete',
            'Total'
        ];
    }

    public function title(): string
    {
        return 'Costo unitario cirugias';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'italic' => true]],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'R' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'S' => NumberFormat::FORMAT_PERCENTAGE,
            'T' => NumberFormat::FORMAT_PERCENTAGE,
            'U' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'V' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'W' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'X' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'Y' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'Z' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'AA' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'AB' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'AC' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'AD' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
        ];
    }
}
