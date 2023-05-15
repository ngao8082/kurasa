<?php

namespace App\Imports;

use App\Models\Employees;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employees([
            "name"=>$row['name'],
             "type"=>$row['type'],
             "gender"=>$row['gender'],
             "manager_id"=>$row['manager_id']
        ]);
    }
}
