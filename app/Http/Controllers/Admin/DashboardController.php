<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Video;
use App\Traits\NepaliDateConverter;

class DashboardController extends Controller
{
    use NepaliDateConverter;

    public function index()
    {
        $notice = Notice::select('id')->get();
        $video_count = Video::count();
        $employee_count = Employee::count();
        $notice_count = $notice->where('type','Notice')->count();
        $news_count = $notice->where('type','News')->count();


        return view('admin.dashboard', compact('employee_count', 'video_count', 'notice_count', 'news_count'));
    }
}
