<?php

use Illuminate\Database\Seeder;
use App\Models\Employee;

class Employees extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $emp = new Employee();
        $emp->mail_address = "admin@gmail.com";
        $emp->password = bcrypt('123456');
        $emp->name = "Nguyen tien manh";
        $emp->role = 1;
        $emp->status = 1;
        $emp->save();
    }
}
