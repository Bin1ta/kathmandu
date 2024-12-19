@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-home"></i> गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.popUpSetting.index') }}">PopUp Notice</a>
                        </li>
                        <li class="breadcrumb-item active">PopUp Notice सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">PopUp Notice</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> PopUp Notice</h4>
                        <a class="btn btn-info btn-sm" href="{{ route('admin.popUpSetting.create') }}">
                            पप अप थप्नुहोस
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शिर्षक</th>
                                    <th>फोटो</th>
                                    <th>पप-आप देखाउने समय</th>
                                    <th>पप-आप फिर्ता हुने समय</th>
                                    <th>वडा</th>
                                    <th>पालिकामा पनि देखाउने</th>
                                    <th>स्थिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popUpSettings as $popUpSetting)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $popUpSetting->title }}</td>
                                        <td><img src="{{ $popUpSetting->image_url }}" alt="Image" width="80"></td>
                                        <td>
                                            {{ $popUpSetting->display_duration }}
                                        </td>
                                        <td>
                                            {{ $popUpSetting->iteration_duration }}
                                        </td>
                                        <td>
                                            {{ implode(',', $popUpSetting->popupActivations->pluck('ward')->toArray()) }}
                                        </td>

                                        <td>
                                            @if ($popUpSetting->is_displayed == 1)
                                                <i class="fa-solid fa-circle-check fa-2x" style="color:green"></i>
                                            @else
                                                <i class="fa-solid fa-circle-xmark fa-2x" style="color:red"></i>
                                            @endif
                                        </td>


                                        <td class="d-flex gap-1">

                                            <form action="{{ route('admin.popUpSetting.updateStatus', $popUpSetting) }}"
                                                method="post" style="display: inline">
                                                @csrf
                                                @method('put')
                                                <button type="submit"
                                                    class="btn btn-{{ $popUpSetting->is_active == 1 ? 'success' : 'danger' }}">
                                                    {{ $popUpSetting->is_active == 1 ? 'पप-अप बन्द गर्नुहोस' : 'पप-अप देखाउनुहोस' }}
                                                </button>
                                            </form>


                                        </td>
                                        <td>
                                            @if (empty(auth()->user()->ward_no) || auth()->id() == $popUpSetting->user_id)
                                            <a data-bs-type="edit"
                                                href="{{ route('admin.popUpSetting.edit', $popUpSetting) }}"
                                                class="btn btn-xs btn-outline-primary " title="सम्पादन गर्नुहोस्">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endif


                                                @if (empty(auth()->user()->ward_no) || auth()->id() == $popUpSetting->user_id)
                                                    <form action="{{ route('admin.popUpSetting.destroy', $popUpSetting) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-bs-type="delete"
                                                            class="btn btn-xs btn-outline-danger show_confirm"
                                                            title="मेटाउनु होस्">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif

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
                </div>
            </div>
        </div>
    </div>
@endsection
