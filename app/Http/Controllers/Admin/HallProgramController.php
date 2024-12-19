<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallProgram\StoreHallProgramRequest;
use App\Http\Requests\HallProgram\UpdateHallProgramRequest;
use App\Models\Hall;
use App\Models\HallProgram;
use Illuminate\Http\Request;

class HallProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization('hall_program_access');

        $hallPrograms = HallProgram::
          where(function ($q) {
             if (!empty(auth()->user()->ward_no)) {
                $authWardNo = auth()->user()->ward_no;
                $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
            }
        })
        ->paginate(10);
        return view('admin.hallProgram.index',compact('hallPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkAuthorization('hall_program_create');
        $halls=Hall::latest()->get();
        return view('admin.hallProgram.create',compact('halls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHallProgramRequest $request)
    {
        HallProgram::create($request->validated() + ['ward'=>auth()->user()->ward_no,'user_id'=>auth()->user()->id]);
        toast('हल कार्यक्रमको थपियो', 'success');
        return to_route('admin.hallProgram.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(HallProgram $hallProgram)
    {
        return view('admin.hallProgram.show',compact('hallProgram'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HallProgram $hallProgram)
    {
        $this->checkAuthorization('hall_program_edit');
        $hallProgram->load('hall');
        return view('admin.hallProgram.edit', compact('hallProgram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHallProgramRequest $request, HallProgram $hallProgram)
    {

        $hallProgram->update($request->validated());
        toast('हल कार्यक्रमको थपियो', 'success');
        return to_route('admin.hallProgram.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HallProgram $hallProgram)
    {
        $hallProgram->delete();
        toast('हल कार्यक्रमको थपियो', 'success');
        return back();
    }
    public function updateStatus(HallProgram $hallProgram)
    {
        $hallProgram->update([
            'status' => !$hallProgram->status,
        ]);
        toast('स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}
