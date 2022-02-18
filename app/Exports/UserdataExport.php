<?php

namespace App\Exports;

use App\User;
use App\Userdata;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserdataExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::join('userdatas', 'users.id', '=', 'userdatas.user_id')->orderBy('inserted_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'StudentID',
            'Scenes',
            'Number',
            'Data',
            'Insert_Time',
        ];
    }

    public function map($row): array{
        $fields = [
           $row->name,
           $row->class,
           $row->scenes,
           $row->topic,
           $row->inputdata,
           $row->inserted_at,

      ];
     return $fields;
 }
}
