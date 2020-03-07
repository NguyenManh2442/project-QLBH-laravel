<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Employees extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $emp = new \App\Employees();
        $emp->email = "manhabc@gmail.com";
        $emp->password = bcrypt('12345678');
        $emp->employeeName = "Nguyen tien manh";
        $emp->save();
    }
}
