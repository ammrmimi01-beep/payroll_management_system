<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Department::create($request->all());

       // Added ->with('success', ...)
        return redirect()->route('departments.index')->with('success', 'Department Added successfully!');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $department->update($request->all());

        // Added ->with('success', ...)
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

   public function destroy(Department $department)
    {
        if ($department->employees()->exists()) {
            return back()->with('error', 'This department cannot be deleted due to existing employee in this department');
        }

        $department->delete();

        return back()->with('success', 'Department deleted successfully');
    }
}
