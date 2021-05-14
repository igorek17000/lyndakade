<?php

namespace App\Imports;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        $res = array();
        foreach ((new User)->getTableColumns() as $column)
            if ($column === "password")
                $res[$column] = Hash::make($row[$column]);
            else
                $res[$column] = $row[$column];

        return new User($res);
    }
}
