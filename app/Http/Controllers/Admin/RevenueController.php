<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Revenue\StoreRevenueRequest;
use App\Http\Requests\Revenue\UpdateRevenueRequest;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $revenues = Revenue::where(function ($q){
            if (!empty(auth()->user()->ward_no)) {
                $authWardNo = auth()->user()->ward_no;
                $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
            }
            })
            ->get();
        return view('admin.revenue.index', compact('revenues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.revenue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRevenueRequest $request)
    {
        Revenue::create($request->validated()+['ward'=>auth()->user()->ward_no,'user_id'=>auth()->id()]);
        toast('राजस्व थपियो', 'success');
        return back();    }

    /**
     * Display the specified resource.
     */
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Revenue $revenue)
    {
        return view('admin.revenue.edit',compact('revenue'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRevenueRequest $request, Revenue $revenue)
    {
        $revenue->update($request->validated());
        toast('राजस्व सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.revenue.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        $revenue->delete();
        toast('राजस्व सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}
