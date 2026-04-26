<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::all();

        $employees = Employee::with('department')
            ->when($request->department_id, function ($query) use ($request) {
                $query->where('department_id', $request->department_id);
            })
            ->paginate(5)
            ->withQueryString();

        return view('employees.index', compact('employees', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'department_id' => 'required',
            'basic_salary' => 'required',
            'allowance' => 'required',
            'overtime_hours' => 'required',
            'hourly_rate' => 'required',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee Added Successfully!');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee Updated Successfully!');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->payrolls()->exists()) {
            return back()->with('error', 'This employee cannot be deleted because payroll records exist.');
        }

        $employee->delete();
        return redirect()
        ->route('employees.index')
        ->with('success', 'Employee deleted successfully.');
    }
}
