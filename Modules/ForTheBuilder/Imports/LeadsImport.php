<?php

namespace Modules\ForTheBuilder\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\ForTheBuilder\Entities\Leads;

class LeadsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
//        dd($rows);
        foreach ($rows as $row){
            $data = [
                'name'     => $row['1'],
                'phone'    => $row['2'],
                'referer' => $row['3'],
                'requestid' => $row['4'],
                'status' => $row['5'],
//                'interview_date' => $row['5'],
            ];

            Leads::create($data);
        };
    }

//    public function rules(): array
//    {
//        return[
//            'name' => 'required',
//            'phone' => 'required',
//            'referer' => 'required',
//            'requestid' => 'required',
//            'status' => 'required',
//            'interview_date' => 'required',
//        ];
//    }
}
