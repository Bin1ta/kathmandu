<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfficeSettingRequest;
use App\Models\OfficeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class OfficeSettingController extends Controller
{
    public function index()
    {

        $this->checkAuthorization('officeSetting_access');
        $officeSetting = OfficeSetting::where(function ($q){
            if (!empty(auth()->user()->ward_no)){
                $q->where('ward_no', auth()->user()->ward_no);
            }else{
                $q->whereNull('ward_no');
            }
        })
        ->first();

        return view('admin.setting.officeSetting.index', compact('officeSetting'));
    }

    public function store(StoreOfficeSettingRequest $request)
    {
        $this->checkAuthorization('officeSetting_edit');

        $officeSetting = OfficeSetting::where(function ($q){
            if (!empty(auth()->user()->ward_no)){
                $q->where('ward_no', auth()->user()->ward_no);
            }else{
                $q->whereNull('ward_no');
            }
        })
            ->first();

        if (!empty($officeSetting)){
            if ($request->hasFile('logo') && $officeSetting->logo) {
                $this->deleteFile($officeSetting->logo);
            }
            if ($request->hasFile('logo1') && $officeSetting->logo1) {
                $this->deleteFile($officeSetting->logo1);
            }
            if ($request->hasFile('logo2') && $officeSetting->logo2) {
                $this->deleteFile($officeSetting->logo2);
            }
            if ($request->hasFile('background_image') && $officeSetting->background_image) {
                $this->deleteFile($officeSetting->background_image);
            }
            $officeSetting->update($request->validated());
        }else{
            OfficeSetting::create($request->validated()+['ward_no'=>auth()->user()->ward_no]);
        }


        Cache::forget('office_setting');

        toast('कार्यालय सेटिङ सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }
}
