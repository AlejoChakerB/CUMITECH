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

class SecondSheetExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle, WithColumnFormatting

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
            'CUPS',
            'Descripcion',
            'Código paquete',
            '% Participacion',
            '% Liquidación',
            'Cantidad',
            'Valor facturado',
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
        return 'Costo promedio por procedimientos';
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
            'D' => NumberFormat::FORMAT_PERCENTAGE,
            'E' => NumberFormat::FORMAT_PERCENTAGE,
            'G' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'H' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'I' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'J' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'K' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'L' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'M' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'N' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'O' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'P' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'Q' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
        ];
    }
}
