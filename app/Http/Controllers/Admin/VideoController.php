<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\StoreVideoRequest;
use App\Http\Requests\Video\UpdateVideoRequest;
use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;

class VideoController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('video_access');

        $videos = Video::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title'], request('search'));
            }

            if (!empty(auth()->user()->ward_no)) {
                $authWardNo = auth()->user()->ward_no;
                $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
            }
        })
            ->latest()
            ->simplePaginate(10);


        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        $this->checkAuthorization('video_create');

        return view('admin.video.create');
    }

    public function store(StoreVideoRequest $request)
    {
        $this->checkAuthorization('video_create');

        Video::create($request->validated() + ['ward' => auth()->user()->ward_no, "user_id" => auth()->id()]);

        toast('भिडियो सफलतापूर्वक थपियो', 'success');

        return back();
    }
    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }
    public function update(UpdateVideoRequest $request,Video $video)
    {
        $video->update($request->validated());
        toast('भिडियो सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('admin.video.index'));
    }

    public function destroy(Video $video)
    {
        $this->checkAuthorization('video_delete');

        if ($video->video) {
            $this->deleteFile($video->video);
        }
        $video->delete();

        toast('भिडियो सफलतापूर्वक मेटियो', 'success');

        return back();
    }
    public function updateVideoStatus(Video $video)
    {
        $video->update([
            'status' => !$video->status
        ]);
        toast(('भिडियो स्थिति अपडेट गरियो'), 'success');
        return back();
    }
}
