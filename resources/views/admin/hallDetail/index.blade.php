@extends('admin.layouts.master')

@section('content')
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
                            <a href="{{route('admin.dashboard')}}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active">हल विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">हल विवरणहरु</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">हल विवरण</h4>
                        <div class="d-flex flex-wrap align-items-center">
                                <a href="{{route('admin.hallDetail.create')}}"
                                   class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                        </div>
                    </div>
                </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>क्र.स</th>
                            <th>शिर्षक</th>
                            <th>स्थिति</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hallDetails as $hallDetail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $hallDetail->title }}</td>
                                <td>
                                    <a href="{{route('admin.hallDetail.updateStatus',$hallDetail)}}"
                                       class="btn btn-xs btn-outline-{{$hallDetail->status==null ?'primary':'danger'}}">
                                        <i class="fa  {{$hallDetail->status==null ?' fa-check':'fa-window-close'}}"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.hallDetail.edit', $hallDetail) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit" title="सम्पादन गर्नुहोस"></i></a>

                                    <form action="{{ route('admin.hallDetail.destroy', $hallDetail) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button data-bs-type="delete"
                                                    class="btn btn-xs btn-outline-danger show_confirm"
                                                    title="मेटाउनु होस्">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
