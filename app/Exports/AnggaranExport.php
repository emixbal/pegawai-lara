<?php

namespace App\Exports;

use App\Models\Anggaran;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class AnggaranExport implements FromCollection, WithHeadings, WithStyles
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function collection()
    {
        $anggarans = Anggaran::whereNull("anggarans.deleted_at")
            ->select(
                'anggarans.year',
                'kode_rekenings.kode',
                'anggarans.description',
                'anggarans.nominal_awal',
                'anggarans.nominal',
                'anggarans.realisasi',
                DB::raw('anggarans.nominal - anggarans.realisasi as sisa'),
            )
            ->where('year', $this->year)
            ->join('kode_rekenings', 'anggarans.kode_rekening_id', '=', 'kode_rekenings.id') // Join the related table
            ->get();

        return $anggarans;
    }

    public function headings(): array
    {
        return [
            ['Rekap Anggaran ' . $this->year, '', '', '', '', ''],
            [
                'Tahun',
                'Kode Rekening',
                'Uraian',
                'Nominal Awal',
                'Nominal Setelah Perubahan (Rp)',
                'Realisasi (Rp)',
                'Sisa (Rp)',
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
