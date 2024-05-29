<?php
// app/Exports/UsersExport.php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromView, WithMapping
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function view(): View
    {
        return view('spj.excel', [
            'users' => $this->users,
        ]);
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->age,
        ];
    }
}
