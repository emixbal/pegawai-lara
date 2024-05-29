<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;

class SPJExport implements FromView
{
    protected $data;
    protected $bendahara;

    public function __construct($data, $bendahara)
    {
        $this->data = $data;
        $this->bendahara = $bendahara;
    }

    public function view(): View
    {
        return view('spj.list_spj_excel', [
            'data' => $this->data,
            'bendahara' => $this->bendahara,
        ]);
    }
}
