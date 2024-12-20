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
                            <a href="{{route('admin.hallProgram.index')}}</a>
                        </li>
                        <li class="breadcrumb-item active">हल कार्यक्रम </li>
                    </ol>
                </div>
                <h4 class="page-title">हल कार्यक्रम</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">हल कार्यक्रमहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            @can('notice_create')
                                <a href="{{route('admin.hallProgram.create')}}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
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
                                <th>कार्यक्रमको नाम</th>
                                <th> कार्यक्रम मिति</th>
                                <th>कार्यक्रमको हुने देखि</th>
                                <th>कार्यक्रमको हुने सम्म</th>
                                <th>स्थिति</th>

                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($hallPrograms as $hallProgram)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$hallProgram->program_name}}</td>
                                    <td>{{$hallProgram->program_date}}</td>
                                    <td>{{$hallProgram->program_time_to}}</td>
                                    <td>{{$hallProgram->program_time_from}}</td>
                                    <td>

                                        <form action="{{ route('admin.hallProgram.updateStatus', $hallProgram) }}" method="post" style="display: inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit"
                                                    class="btn btn-xs btn-outline-{{ $hallProgram->status == 1 ? 'primary' : 'danger' }}">
                                                <i class="fa {{ $hallProgram->status == 1 ? 'fa-check' : 'fa-window-close' }}"></i>

                                            </button>
                                        </form>

                                    </td>

                                    <td class="d-flex gap-1">
                                        <a data-bs-type="edit" href="{{route('admin.hallProgram.show',$hallProgram)}}"
                                           class="btn btn-xs btn-outline-primary"
                                           title="विवरण हेर्नुहोस्">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('hall_program_edit')
                                            <a data-bs-type="edit"
                                               href="{{route('admin.hallProgram.edit',$hallProgram)}}"
                                               class="btn btn-xs btn-outline-primary "
                                               title="सम्पादन गर्नुहोस्">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('hall_program_delete')
                                            <form action="{{route('admin.hallProgram.destroy',$hallProgram)}}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <button
                                                    class="btn btn-xs btn-outline-danger  show_confirm"
                                                    data-bs-type="delete" title="मेटाउनु होस्">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{-- {{ $hallPrograms->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
