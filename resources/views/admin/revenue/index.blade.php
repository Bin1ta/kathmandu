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
                            <a href="{{route('admin.revenue.index')}}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active">राजस्व</li>
                    </ol>
                </div>
                <h4 class="page-title">राजस्व</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">राजस्व</h4>
                        <div class="d-flex flex-wrap align-items-center">
                                <a href="{{route('admin.revenue.create')}}"
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
                                <th>विवरण</th>
                                <th>रकम</th>
                                <th>कैफियत</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($revenues as $revenue)
                                <tr>
                                    <td >{{$loop->iteration}}</td>
                                    <td>{{ $revenue->particulars }}</td>
                                    <td>{{ $revenue->amount }}</td>
                                    <td>{{ $revenue->remarks}}</td>
                                    <td>
                                        <a data-bs-type="edit" href="{{route('admin.revenue.edit',$revenue)}}"
                                           class="btn btn-xs btn-outline-primary" title="सम्पादन गर्नुहोस्">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{route('admin.revenue.destroy',$revenue)}}"
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

