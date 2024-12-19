<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CitizenCharterResource;
use App\Http\Resources\v1\EmployeeResource;
use App\Http\Resources\v1\HeaderResource;
use App\Http\Resources\v1\NewsResource;
use App\Http\Resources\v1\NoticeResource;
use App\Http\Resources\v1\OfficeSettingResource;
use App\Http\Resources\v1\ProgramResource;
use App\Http\Resources\v1\VideoResource;
use App\Models\CitizenCharter;
use App\Models\Employee;
use App\Models\Header;
use App\Models\Notice;
use App\Models\OfficeSetting;
use App\Models\Program;
use App\Models\Video;
use Illuminate\Http\Request;

class DigitalBoardController extends Controller
{
    public function home()
    {
        return $this->extracted();

    }
    public function ward($ward)
    {
        return $this->extracted($ward);

    }

    public function officeSetting()
    {
        $officeSetting = OfficeSetting::whereNull('ward_no')->first();

         return   OfficeSettingResource::make($officeSetting);

    }

    /**
     * @param null $ward
     * @return array
     */
    public function extracted($ward = null): array
    {
        $notices = Notice::contentType('News')
            ->showInIndex()
            ->where(function ($q) use ($ward) {
                if (!empty($ward)) {
                    $q->whereRaw("FIND_IN_SET('$ward', ward) > 0");
                } else {
                    $q->MainPageDisplay();
                }
            })
            ->whereNull('closed_at')
            ->orderByDesc('date')
            ->get();

        $employees = Employee::active()
            ->showInIndex()
            ->where(function ($q) use ($ward) {
                if (!empty($ward)) {
                    $q->whereRaw("FIND_IN_SET('$ward', ward) > 0");
                } else {
                    $q->MainPageDisplay();
                }
            })
            ->orderBy('position')
            ->get();

        $videos = Video::where('status',1)
            ->where(function ($q) use ($ward) {
                if (!empty($ward)) {
                    $q->whereRaw("FIND_IN_SET('$ward', ward) > 0");
                } else {
                    $q->MainPageDisplay();
                }
            })
            ->latest()
            ->get()
            ->pluck('video');

        $citizenCharters = CitizenCharter::with('branch')
            ->where(function ($q) use ($ward) {
                if (!empty($ward)) {
                    $q->whereRaw("FIND_IN_SET('$ward', ward) > 0");
                } else {
                    $q->MainPageDisplay();
                }
            })
            ->orderBy('branch_id')
            ->get();

        $programs = Program::where('is_displayed', 1)
            ->where('status', 1)
            ->orderByDesc('date')
            ->get();

        $headers = Header::where(function ($q) use ($ward) {
            if (!empty($ward)) {
                $q->where('ward', $ward);
            }else{
                $q->whereNull('ward');
            }
        })
            ->orderBy('position')
            ->get();

        return [
            'newses' => NewsResource::collection($notices),

            'videos' => $videos,
            'employees' => [
                'representative' => EmployeeResource::collection($employees->where('is_employee', 0)),
                'employee' => EmployeeResource::collection($employees->where('is_employee', 1))
            ],
            'citizenCharters' => CitizenCharterResource::collection($citizenCharters),
            'programs' => ProgramResource::collection($programs),
            'headers' => HeaderResource::collection($headers),
            'officeSettings' => $this->officeSetting()

        ];
    }


}
