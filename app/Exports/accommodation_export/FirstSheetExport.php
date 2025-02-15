<?php

namespace App\Exports\accommodation_export;

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
            'Centro de costos', //A
            'Gastos fijos', //B
            'Gastos variables', //C
            'Gastos administrativos', //D
            'Gastos logisticos', //E
            'Mano de obra planta', //F
            'Mano de obra contratada', //G
            'Costo unitario' //H
        ];
    }

    public function title(): string
    {
        return 'Costo promedio centro de costos';
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
            'B' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'D' como moneda
            'C' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'E' como moneda
            'D' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'F' como moneda
            'E' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'G' como moneda
            'F' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'H' como moneda
            'G' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'I' como moneda
            'H' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE  // Formatear columna 'J' como moneda
        ];
    }
}
