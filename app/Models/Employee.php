<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $perPage = 12;

    protected $table = 'employees';
    protected $fillable = [
        'mail_address', 'password',
    ];

    public function getAllEmployee(array $request) 
    {
        $query = DB::table('employees');
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                if ($key == 'name' || $key == 'mail_address') {
                    $query->where($key, 'like', '%' . $value . '%');
                } else{
                    $query->where($key, '=', $value);
                }
            }
        }
        return $query->paginate($this->perPage);
    }

    public function createEmployee(array $request)
    {
        $employee = new Employee();
        $employee->name = $request['name'];
        $employee->mail_address = $request['mail_address'];
        $employee->phone = $request['phone'];
        $employee->address = $request['address'];
        $employee->birth_date = $request['birth_date'];
        $employee->role = $request['role'];
        $employee->password = bcrypt($request['password']);
        $employee->save();

        return true;
    }

    public function getOnlyEmployee($id)
    {
        return Employee::find($id);
    }

    public function updateEmployee($id, array $request)
    {
        $employee = Employee::find($id);
        $employee->name = $request['name'];
        $employee->mail_address = $request['mail_address'];
        $employee->phone = $request['phone'];
        $employee->address = $request['address'];
        $employee->birth_date = $request['birth_date'];
        if (empty($request['password'])) {
            $employee->password = bcrypt($request['password']);
        }
        $employee->role = $request['role'];
        $employee->save();
        return true;
    }

    public function deleteEmployee($id)
    {
        Employee::destroy($id);
        return true;
    }
}
