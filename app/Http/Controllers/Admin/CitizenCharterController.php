<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CitizenCharter\StoreCitizenCharterRequest;
use App\Http\Requests\CitizenCharter\UpdateCitizenCharterRequest;
use App\Models\Branch;
use App\Models\CitizenCharter;
use App\Models\User;
use Illuminate\Http\Request;

class CitizenCharterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citizenCharters = CitizenCharter::with('branch')
            ->where(function ($q) {
                 if (!empty(auth()->user()->ward_no)) {
                    $authWardNo = auth()->user()->ward_no;
                    $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
                }
            })
            ->get();
        return view('admin.citizen_charter.index', compact('citizenCharters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('admin.citizen_charter.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitizenCharterRequest $request)
    {
        CitizenCharter::create($request->validated() + [
                'user_id' => auth()->id(),
                'ward' => auth()->user()->ward,
            ]);
        toast('नागरिक वडापत्र थपियो', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CitizenCharter $citizenCharter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CitizenCharter $citizenCharter)
    {
        $branches = Branch::all();
        $users = User::all();
        return view('admin.citizen_charter.edit', compact('citizenCharter', 'branches', 'users'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitizenCharterRequest $request, CitizenCharter $citizenCharter)
    {

        $citizenCharter->update($request->validated());
        toast('नागरिक वडापत्र सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CitizenCharter $citizenCharter)
    {
        $citizenCharter->delete();
        toast('नागरिक वडापत्र  मेटियो', 'success');
        return back();
    }
}
