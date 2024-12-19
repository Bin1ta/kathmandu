<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopUp\StorePopUpRequest;
use App\Http\Requests\PopUp\UpdatePopUpRequest;
use App\Models\PopupSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopUpController extends Controller
{
    public function index()
    { {
            $popUpSettings = PopupSetting::WithWhereHas('popupActivations', function ($q) {
                if (!empty(auth()->user()->ward_no)) {
                    $authWardNo = auth()->user()->ward_no;
                    $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
                }
            })
                ->get();
            return view('admin.popUp.index', compact('popUpSettings'));
        }
    }


    public function create()
    {
        return view('admin.popUp.create');
    }

    public function store(StorePopUpRequest $request)
    {
        DB::transaction(function () use ($request) {
            $popup = PopupSetting::create($request->validated() + ['user_id' => auth()->id()]);
            if (!empty($request->input('ward'))) {
                foreach ($request->input('ward') as $ward) {
                    $popup->popupActivations()->create([
                        'is_active' => 1,
                        'ward' => $ward
                    ]);
                }
            } else {
                $popup->popupActivations()->create([
                    'is_active' => 1,
                    'ward' => auth()->user()->ward_no
                ]);
            }
        });


        toast('PopUp सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
    public function edit(PopupSetting $popUpSetting)
    {
        return view('admin.popUp.edit', compact('popUpSetting'));
    }

    // public function update(UpdatePopUpRequest $request, PopupSetting $popUpSetting)
    // {
    //     $popUpSetting->update($request->validated());
    //     toast('PopUp सफलतापूर्वक अद्यावधिक गरियो', 'success');
    //     return redirect(route('admin.popUpSetting.index'));
    // }
    public function update(UpdatePopUpRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $popUpSetting = PopupSetting::findOrFail($id);
            $popUpSetting->update($request->validated() + ['user_id' => auth()->id()]);

            $popUpSetting->popupActivations()->delete();
            if (!empty($request->input('ward'))) {
                foreach ($request->input('ward') as $ward) {
                    $popUpSetting->popupActivations()->create([
                        'is_active' => 1,
                        'ward' => $ward
                    ]);
                }
            } else {
                $popUpSetting->popupActivations()->create([
                    'is_active' => 1,
                    'ward' => auth()->user()->ward_no
                ]);
            }
        });
        toast('PopUp सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.popUpSetting.index'));
    }
    public function updateStatus(PopupSetting $popUpSetting)
    {

        if (empty(auth()->user()->ward_no) || auth()->id() == $popUpSetting->user_id) {
            $popUpSetting->update([
                'is_active' => !$popUpSetting->is_active
            ]);
            toast('PopUp स्थिति अपडेट गरियो', 'success');
            return back();
        } else {
            toast('PopUp स्थिति अपडेट गरने अनुमाति छैन', 'error');
            return back();
        }
    }

    public function destroy(PopupSetting $popUpSetting)
    {
        $popUpSetting->delete();
        toast('PopUp सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}
