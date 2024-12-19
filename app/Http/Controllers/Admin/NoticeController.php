<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notice\UpdateNoticeRequest;
use App\Models\Notice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class NoticeController extends Controller
{
    public function index(string $type)
    {
        $this->checkAuthorization('notice_access');
        $notices = Notice::with('user')
            ->where(function ($q) {
                if (!empty(auth()->user()->ward_no)) {
                    $q->where('ward', auth()->user()->ward_no);
                }
            })
            ->contentType($type)
            ->orderByDesc('date')
            ->where(function (Builder $q) {
                if (!empty(auth()->user()->ward_no)) {
                    $authWardNo = auth()->user()->ward_no;
                    $q->whereRaw("FIND_IN_SET('$authWardNo', ward) > 0");
                }
            })
            ->latest()
            ->simplePaginate(10);


        return view('admin.notice.index', compact('notices', 'type'));
    }

    public function create(string $type)
    {
        $this->checkAuthorization('notice_create');

        return view('admin.notice.create', compact('type'));
    }

    public function store(string $type, Request $request)
    {
      
        $this->checkAuthorization('notice_create');

        if ($type === 'News') {
            $data = $request->validate([
                'title' => ['required', 'string'],
                'date' => ['required'],
                'description' => ['nullable'],
                'closed_at' => ['nullable'],
                'show_on_index' => ['nullable', 'boolean'],
                'ward' => ['nullable', 'array'],
                'is_displayed' => ['nullable', 'boolean']
            ]);
        } else {
            $data = $request->validate([
                'title' => ['required', 'string'],
                'date' => ['required'],
                'description' => ['nullable'],
                'closed_at' => ['nullable'],
                'show_on_index' => ['nullable', 'boolean'],
                'files' => ['array', 'required'],
                'files.*' => ['mimes:png,jpeg,jpg'],
                'ward' => ['nullable', 'array'],
                'is_displayed' => ['nullable', 'boolean']
            ]);
        }


        DB::transaction(function () use ($request, $type, $data) {

            $notice = Notice::create($data + [
                'ward' => auth()->user()->ward_no,
                "user_id" => auth()->id(),
                'type' => $type,
            ]);

            if ($request->hasFile('files')) {
                $this->fileUpload($notice, $request);
            }
        });

        toast($type === 'News' ? 'समाचार सफलतापूर्वक थपियो' : 'सूचना सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(string $type, Notice $notice)
    {
        $this->checkAuthorization('notice_access');

        $notice->load('files');

        return view('admin.notice.show', compact('notice', 'type'));
    }

    public function edit(string $type, Notice $notice)
    {
        $this->checkAuthorization('notice_edit');

        return view('admin.notice.edit', compact('notice', 'type'));
    }

    public function update(string $type, UpdateNoticeRequest $request, Notice $notice)
    {
        $this->checkAuthorization('notice_edit');

        DB::transaction(function () use ($request, $notice) {
            $notice->update($request->validated());
            if ($request->hasFile('files')) {
                $this->fileUpload($notice, $request);
            }
        });

        toast($type === 'News' ? 'समाचार सफलतापूर्वक अद्यावधिक गरियो' : 'सूचना सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.notice.index', $type));
    }

    public function destroy(string $type, Notice $notice): RedirectResponse
    {
        $this->checkAuthorization('notice_delete');

        foreach ($notice->files as $file) {
            $this->deleteFile($file->file);
        }
        $notice->files()->delete();
        $notice->delete();

        toast($type . ' सफलतापूर्वक मेटियो', 'success');

        return back();
    }

    public function updateClosedDate($type, Notice $notice): RedirectResponse
    {
        $notice->update([
            'closed_at' => !empty($notice->closed_at) ? null : now(),
        ]);
        toast('स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function updateShowOnIndex($type, Notice $notice): RedirectResponse
    {
        $notice->update([
            'show_on_index' => !$notice->show_on_index,
        ]);
        toast('स्थिति सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return back();
    }

    public function fileUpload($notice, $request): void
    {
        foreach ($request->file('files') as $file) {
            $extension = $file->getClientOriginalExtension();
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $notice->files()->create([
                'file_name' => $name,
                'extension' => $extension,
                'file' => $file->store('notice/' . Str::slug($request->input('title'), '_'), 'public'),
            ]);
        }
    }
}
