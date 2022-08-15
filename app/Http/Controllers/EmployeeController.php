<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.index', [
            'employees' => Employee::with('getUser')->orderBy('name', 'asc')->get()
        ]);
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            $employee = new Employee();
            $employee->setData($user->id, $request);
            $employee->save();
            DB::commit();

            $this->message(true, 'Data successfully created.', '');
        } catch (Exception $e) {
            DB::rollBack();
            $this->message(false, '', 'Failed to store data. ' . $e->getMessage());
        }

        return redirect()->route('employee.manage.index');
    }

    public function edit($id)
    {
        return view('admin.employee.edit', [
            'employee' => Employee::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $employee = Employee::find($id);
            $employee->setData($employee->user_id, $request);
            $employee->save();
            DB::commit();

            $this->message(true, 'Data successfully updated.', '');
        } catch (Exception $e) {
            DB::rollBack();
            $this->message(false, '', 'Failed to update data. ' . $e->getMessage());
        }

        return redirect()->route('employee.manage.index');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        User::find($employee->user_id)->delete();
        $this->message(true, 'Data successfully deleted.', '');

        return redirect()->route('employee.manage.index');
    }
}

