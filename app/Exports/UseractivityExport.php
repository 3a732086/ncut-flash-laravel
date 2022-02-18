<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UseractivityExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $user = User::where('role','1')->get();
    }

    public function headings(): array
    {
        return [
            '最近登入時間',
            '姓名',
            '學號',
            '編號',

        ];
    }

    public function map($row): array{
        $fields = [
           $row->updated_at,
           $row->name,
           $row->class,
           $row->id,
      ];
     return $fields;
 }
}
