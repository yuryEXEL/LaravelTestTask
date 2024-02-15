<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * Get collection users
     *
     * @return Collection
     */
    public function collection()
    {
        return User::all('username');
    }

    /**
     * Write code on Method
     *
     * @return array
     */
    public function headings(): array
    {
        return ["username"];
    }
}
