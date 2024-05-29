<?php

namespace App\Exports;

use App\Models\Dewan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DewanExport implements FromCollection, WithHeadings, WithStyles
{
    protected $period;

    public function __construct($period)
    {
        $this->period = $period;
    }

    public function collection()
    {
        $query = Dewan::whereNull("dewans.deleted_at")
            ->join('pegawais', 'dewans.pegawai_id', '=', 'pegawais.id')
            ->join('periods', 'dewans.period_id', '=', 'periods.id')
            ->select('dewans.id', 'dewans.name', 'pegawais.name as pegawai', 'dewans.nik', 'dewans.npwp', 'dewans.nomer_rekening');
        $query->where('periods.name', $this->period);

        $dewans = $query->get();

        return $dewans;
    }

    public function headings(): array
    {
        return [
            ['Rekap Dewan ' . $this->period, '', '', '', '', ''],
            [
                'ID',
                'Nama',
                'Pegawai',
                'NIK',
                'NPWP',
                'No Rekening',
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:F1'); // Merge cells for the title row
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Align center

        return [
            // Additional styles if needed
        ];
    }
}
