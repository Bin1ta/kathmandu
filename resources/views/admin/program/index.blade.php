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
                            <a href="{{route('admin.program.index')}}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active">कार्यक्रम</li>
                    </ol>
                </div>
                <h4 class="page-title">कार्यक्रम</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">कार्यक्रम</h4>
                        <div class="d-flex flex-wrap align-items-center">
                                <a href="{{route('admin.program.create')}}"
                                   class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>शिर्षक *</th>
                                <th>मिति</th>
                                <th>फोटो</th>
                                <th>स्थिति </th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($programs as $program)
                                <tr>
                                    <td >{{$loop->iteration}}</td>
                                    <td>{{ $program->title }}</td>
                                    <td>{{ $program->date }}</td>
                                    <td>
                                        <img src="{{ $program->image_url ?? '' }}" height="70" alt="Image">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.program.updateStatus',$program) }}"
                                            method="post" style="display: inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit" style="border: none; background: none;">
                                                <i
                                                    class="fa fa-{{ $program->status == 1 ? 'toggle-on text-success' : 'toggle-off text-danger' }} fa-2x"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a data-bs-type="edit" href="{{route('admin.program.edit',$program)}}"
                                           class="btn btn-xs btn-outline-primary" title="सम्पादन गर्नुहोस्">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{route('admin.program.destroy',$program)}}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button data-bs-type="delete"
                                                    class="btn btn-xs btn-outline-danger show_confirm"
                                                    title="मेटाउनु होस्">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

