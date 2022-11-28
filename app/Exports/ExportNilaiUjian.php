<?php

namespace App\Exports;

use App\Models\Ujian;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportNilaiUjian implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    private $ujian;

    public function __construct(array $ujian)
    {
        $this->ujian = $ujian;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return $this->ujian;
    }

    public function headings(): array
    {
        return [
            'No',
            'NISN',
            'Nama',
            'Nilai',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setSize(12);
        $sheet->getStyle('A1:E1')
        ->getAlignment()
        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }
}
