<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Program\StoreProgramRequest;
use App\Http\Requests\Program\UpdateProgramRequest;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::where(function ($q){
            if (!empty(auth()->user()->ward_no)) {
                $authWardNo = auth()->user()->ward_no;
                $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
            }
        })
        ->get();
        return view('admin.program.index', compact('programs'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramRequest $request)
    {
        Program::create($request->validated()+['ward'=>auth()->user()->ward_no,'user_id'=>auth()->id()]);
        toast('कार्यक्रम थपियो', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('admin.program.edit',compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->validated());
        toast('कार्यक्रम सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.program.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        toast('कार्यक्रम मेटियो', 'success');
        return back();
    }
     public function updateProgramStatus(Program $program)
    {
        $program->update([
            'status' => !$program->status
        ]);
        toast( ('कार्यक्रम स्थिति अपडेट गरियो'), 'success');
        return back();
    }
}
