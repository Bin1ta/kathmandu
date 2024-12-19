@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                                <i class="fa fa-home"></i> गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.video.index')}}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active">भिडियो </li>
                    </ol>
                </div>
                <h4 class="page-title">भिडियो </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">भिडियोहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            @can('video_create')
                                <a href="{{route('admin.video.create')}}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>शिर्षक </th>
                                <th>भिडियो </th>
                                <th>स्थिति </th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($videos as $video)
                                <tr>
                                    <th scope="row" class="align-middle">
                                        {{$loop->iteration}}
                                    </th>
                                    <td class="align-middle">
                                        {{$video->title}}
                                    </td>
                                    <td class="align-middle">
                                        {{extractYouTubeVideoId($video->video)}}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.video.updateStatus',$video) }}"
                                            method="post" style="display: inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit" style="border: none; background: none;">
                                                <i
                                                    class="fa fa-{{ $video->status == 1 ? 'toggle-on text-success' : 'toggle-off text-danger' }} fa-2x"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="align-middle d-flex gap-1">
                                        <a data-bs-type="edit" href="{{route('admin.video.edit',$video)}}"
                                        class="btn btn-xs btn-outline-primary" title="सम्पादन गर्नुहोस्">
                                         <i class="fa fa-edit"></i>
                                     </a>
                                        @can('video_delete')
                                            @if(empty(auth()->user()->ward_no) || auth()->id() == $video->user_id)
                                                <form action="{{route('admin.video.destroy',$video)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-bs-type="delete" class="btn btn-xs btn-outline-danger show_confirm" title="मेटाउनु होस्">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif

                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $videos->onEachSide(config('app.pagination_count'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
