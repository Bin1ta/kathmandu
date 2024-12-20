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
                            <a href="{{route('admin.hallProgram.index')}}">हल कार्यक्रम </a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ हल कार्यक्रम थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">हल कार्यक्रम </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">हल कार्यक्रम थप्नुहोस्</h4>
                        <a href="{{route('admin.hallProgram.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> हल कार्यक्रम सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form action="{{route('admin.hallProgram.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label"> कार्यक्रम आयोजकको नाम*</label>
                                    <input
                                            type="text"
                                            name="program_name"
                                            value="{{old('program_name')}}"
                                            class="form-control @error('program_name') is-invalid @enderror"
                                            id="program_name"
                                            placeholder="शिर्षक "
                                            required
                                    />
                                    @error('program_name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label"> कार्यक्रमको मिति *</label>
                                    <input
                                            type="text"
                                            name="program_date"
                                            value="{{old('program_date')}}"
                                            class="form-control @error('program_date') is-invalid @enderror"
                                            id="program_date"
                                            placeholder="मिति"
                                            required
                                    />
                                    @error('program_date')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="program_detail" class="form-label">कार्यक्रम बिवरण </label>
                                    <textarea name="program_detail" id="program_detail" placeholder="कार्यक्रम बिवरण"
                                              class="form-control summernote" cols="30"
                                              rows="5">{{old('program_detail')}}</textarea>
                                    @error('program_detail')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label"> कार्यक्रमको हुने समय (देखि) *</label>
                                    <input
                                            type="text"
                                            name="program_time_to"
                                            value="{{old('program_time_to')}}"
                                            class="form-control @error('program_time_to') is-invalid @enderror"
                                            id="program_time_to"
                                            placeholder="मिति"
                                            required
                                    />
                                    @error('program_time_to')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label"> कार्यक्रमको हुने समय (सम्म) *</label>
                                    <input
                                            type="text"
                                            name="program_time_from"
                                            value="{{old('program_time_from')}}"
                                            class="form-control @error('program_time_from') is-invalid @enderror"
                                            id="program_time_from"
                                            placeholder="मिति"
                                            required
                                    />
                                    @error('program_time_from')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label for="hall_id" class="form-label"> हल</label>
                                    <select name="hall_id" id="hall_id" class="form-select @error('hall_id') is-invalid @enderror">
                                        <option value="">हल छान्नुहोस्</option>
                                        @foreach ($halls as $hall)
                                            <option value="{{ $hall->id }}" {{ old('hall_id') == $hall->id ? 'selected':'' }}>{{ $hall->service }}</option>
                                        @endforeach

                                    </select>
                                    @error('hall_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label for="ward" class="form-label">वडा</label>
                                    <select name="ward[]" id="ward" class="form-select"
                                            @if(!empty(auth()->user()->ward_no)) disabled @endif multiple>
                                        <option value="">---वडा छान्नुहोस्---</option>
                                        @foreach(officeSetting()->localbody->ward_no ??[] as $ward)
                                            <option value="{{$ward}}" {{in_array($ward, old('ward',!empty(auth()->user()->ward_no) ? [auth()->user()->ward_no]:[])) ? 'selected' : ''}}>{{$ward}}</option>
                                        @endforeach
                                    </select>
                                    @error('ward')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @error('ward.*')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-2">
                                    <input
                                            type="checkbox"
                                            name="is_displayed"
                                            value="1"
                                            class="form-check-input @error('is_displayed') is-invalid @enderror"
                                            id="is_displayed"/>
                                    <label for="is_displayed" class="form-label">पालिकामा पनि देखाउनु होस्</label>

                                    @error('is_displayed')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="remarks" class="form-label">कैफियत</label>
                                    <textarea name="remarks" id="remarks" placeholder="कैफियत"
                                              class="form-control summernote" cols="30"
                                              rows="5">{{old('remarks')}}</textarea>
                                    @error('remarks')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
