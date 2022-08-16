<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = new Employee();
        $employee->setName('Sistem Administrator');
        $employee->setGender('Laki-laki');
        $employee->setUserId(1);
        $employee->setPhone('08239288888');
        $employee->setAddress('Kebumen');
        $employee->save();
    }
}
