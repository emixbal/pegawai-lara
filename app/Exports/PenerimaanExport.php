<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PenerimaanExport implements FromView
{
    protected $data;
    protected $bendahara;
    protected $periode_bulan;

    public function __construct($data, $bendahara, $periode_bulan)
    {
        $this->data = $data;
        $this->bendahara = $bendahara;
        $this->periode_bulan = $periode_bulan;
    }

    public function view(): View
    {
        return view('penerimaan.list_penerimaan_excel', [
            'data' => $this->data,
            'bendahara' => $this->bendahara,
            'periode_bulan' => $this->periode_bulan,
        ]);
    }
}
