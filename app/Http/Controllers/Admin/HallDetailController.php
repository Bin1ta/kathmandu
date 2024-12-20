<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallDetail\StoreHallDetailRequest;
use App\Http\Requests\HallDetail\UpdateHallDetailRequest;
use App\Models\HallDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HallDetailController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('hall_detail_access');

        $hallDetails = HallDetail::query()
            ->orderByDesc('created_at')
            ->simplePaginate(10);

        return view('admin.hallDetail.index', compact('hallDetails'));
    }

    public function create()
    {
        $this->checkAuthorization('hall_detail_create');

        return view('admin.hallDetail.create');
    }

    public function store(StoreHallDetailRequest $request)
    {
        HallDetail::create($request->validated() + ['user_id' => auth()->id()]);
        toast('Hall Detail created successfully.', 'success');

        return redirect(route('admin.hallDetail.index'));
    }

    public function show(HallDetail $hallDetail)
    {

    }

    public function edit(HallDetail $hallDetail)
    {
        $this->checkAuthorization('hall_detail_edit');

        return view('admin.hallDetail.edit', compact('hallDetail'));
    }

    public function update(UpdateHallDetailRequest $request, HallDetail $hallDetail)
    {
        $this->checkAuthorization('hall_detail_edit');

        $hallDetail->update($request->validated());
        toast('Hall Detail updated successfully.', 'success');

        return redirect(route('admin.hallDetail.index'));
    }

    public function destroy(HallDetail $hallDetail): RedirectResponse
    {
        $this->checkAuthorization('hall_detail_delete');

        $hallDetail->delete();
        toast('Hall Detail deleted successfully.', 'success');

        return back();
    }
    public function updateStatus(HallDetail $hallDetail): RedirectResponse
    {
        $hallDetail->update([
            'status' => !empty($hallDetail->status) ? null : now(),
        ]);
        toast('स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}
