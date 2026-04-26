<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\PayrollRecord;
use App\Services\PayrollService;

class PayrollController extends Controller
{
    public function index()
    {
        return view('payroll.run');
    }

   public function run(Request $request)
{
    $month = $request->month;
    $year = $request->year;

    // Check if payroll has already been run for this period
    $alreadyRun = PayrollRecord::where('month', $month)
        ->where('year', $year)
        ->exists();

    if ($alreadyRun) {
        // (int)$month ensures PHP 8.4 doesn't throw a TypeError
        $monthName = \Carbon\Carbon::createFromDate($year, (int)$month, 1)->format('F');
        
        return back()->with('error', "Payroll for \"$monthName\" \"$year\" has been processed.");
    }

    $employees = Employee::all();
    
    if ($employees->isEmpty()) {
        return back()->with('error', 'No Employees Found To Process Payroll.');
    }

    $service = new PayrollService();

    foreach ($employees as $employee) {
        $data = $service->calculate($employee);

        PayrollRecord::create([
            'employee_id' => $employee->id,
            'month'       => $month,
            'year'        => $year,
            ...$data
        ]);
    }

    return back()->with('success', 'Payroll Process Successfully!');
}

 public function history(Request $request)
{
    $departments = Department::all();

    $records = PayrollRecord::with('employee.department')
        ->when($request->month, fn($q) => $q->where('month', $request->month))
        ->when($request->year, fn($q) => $q->where('year', $request->year))
        ->when($request->department_id, function ($q) use ($request) {
            $q->whereHas('employee', function ($sub) use ($request) {
                $sub->where('department_id', $request->department_id);
            });
        })
        ->paginate(5)
        ->withQueryString();

    return view('payroll.history', compact('records', 'departments'));
}

    public function show($id)
    {
        $record = \App\Models\PayrollRecord::with('employee.department')->findOrFail($id);

        return view('payroll.show', compact('record'));
    }
}