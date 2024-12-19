<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hall\StoreHallRequest;
use App\Http\Requests\Hall\UpdateHallRequest;
use App\Models\Hall;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class HallController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('hall_access');
        $halls = Hall::query()
            ->where(function ($q) {
                if (!empty(auth()->user()->ward_no)) {
                    $authWardNo = auth()->user()->ward_no;
                    $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
                }
            })
            ->orderByDesc('created_at')
            ->simplePaginate(10);

        return view('admin.hall.index', compact('halls'));
    }

    public function create()
    {
        $this->checkAuthorization('hall_create');

        return view('admin.hall.create');
    }

    public function store(StoreHallRequest $request)
    {
        Hall::create($request->validated()+['ward'=>auth()->user()->ward_no,'user_id'=>auth()->id()]);
        toast('हल सफलतापूर्वक थपियो', 'success');
        return redirect(route('admin.hall.index'));
    }

    public function show(Hall $hall)
    {
        $this->checkAuthorization('hall_access');

        return view('admin.hall.show', compact('hall'));
    }

    public function edit(Hall $hall)
    {
        $this->checkAuthorization('hall_edit');

        return view('admin.hall.edit', compact('hall'));
    }

    public function update(UpdateHallRequest $request, Hall $hall)
    {
        $this->checkAuthorization('hall_edit');

        $hall->update($request->validated());

        toast('हल सफलतापूर्वक अद्यावधिक', 'success');


        return redirect(route('admin.hall.index'));
    }

    public function destroy(Hall $hall): RedirectResponse
    {
        $this->checkAuthorization('hall_delete');

        $hall->delete();

        toast('हल सफलतापूर्वक मेटियो', 'success');


        return back();
    }
}
