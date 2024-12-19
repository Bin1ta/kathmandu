<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('employee_access');

        $employees = Employee::orderBy('position')
        ->where(function ($q) {
            if (!empty(auth()->user()->ward_no)) {
                $q->where('ward', auth()->user()->ward_no);
            }
        })
    
        ->where(function (Builder $q) {
            if (!empty(auth()->user()->ward_no)) {
                $authWardNo = auth()->user()->ward_no;
                $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
            }
        })

            ->latest()
            ->simplePaginate(10);


        return view('admin.employee.index', compact('employees'));
    }

    public function create()
    {
        $this->checkAuthorization('employee_create');
        $allEmployees = Employee::orderBy('position')->get();
        return view('admin.employee.create', compact('allEmployees'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->checkAuthorization('employee_create');

        Employee::create($request->validated()+['ward'=>auth()->user()->ward_no, "user_id" => auth()->id()]);
        toast('कर्मचारी सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function edit(Employee $employee)
    {
        $this->checkAuthorization('employee_edit');
        $allEmployees = Employee::where('id', '!=', $employee->id)->get();
        return view('admin.employee.edit', compact('employee', 'allEmployees'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        
        $this->checkAuthorization('employee_edit');

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                $this->deleteFile($employee->photo);
            }
        }
        $employee->update($request->validated());

        toast('कर्मचारी सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.employee.index'));
    }

    public function destroy(Employee $employee)
    {
        $this->checkAuthorization('employee_delete');
        if ($employee->photo) {
            $this->deleteFile($employee->photo);
        }

        $employee->delete();
        toast(' कर्मचारी सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }

    public function updateEmployeeStatus(Employee $employee): RedirectResponse
    {
        $this->checkAuthorization('employee_access');
        $employee->update([
            'status' => !$employee->status,
        ]);
        toast('कर्मचारी स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}
