<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\StoreBranchRequest;
use App\Http\Requests\Branch\UpdateBranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::with('branch')
            ->where(function ($q){
                if (!empty(auth()->user()->ward_no)) {
                    $authWardNo = auth()->user()->ward_no;
                    $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
                }
            })
            ->get();
        return view('admin.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('admin.branch.create',compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        Branch::create($request->validated()+['ward'=>auth()->user()->ward_no,'user_id'=>auth()->id()]);
        toast('शाखा थपियो', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('admin.branch.edit',compact('branch'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {

        $branch->update($request->validated());
        toast('शाखा सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.branch.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        toast('शाखा सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}
