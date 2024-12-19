<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Header\StoreHeaderRequest;
use App\Http\Requests\Header\UpdateHeaderRequest;
use App\Models\Header;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headers = Header::where(function ($q) {
            if (!empty(auth()->user()->ward_no)) {
                $q->where('ward', auth()->user()->ward_no);
            }else{
                $q->whereNull('ward');
            }
        })
            ->orderBy('position')
            ->get();
        return view('admin.header.index', compact('headers'));
    }


    public function create()
    {
        return view('admin.header.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeaderRequest $request)
    {
        Header::create($request->validated() + ['ward' => auth()->user()->ward_no]);
        toast('हेडर थपियो', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Header $header)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Header $header)
    {
        return view('admin.header.edit', compact('header'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeaderRequest $request, Header $header)
    {
        $header->update($request->validated());
        toast('हेडर सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.header.index'));//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Header $header)
    {
        $header->delete();
        toast('हेडर सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}
