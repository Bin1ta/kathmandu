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
                            <a href="{{route('admin.notice.index',$type)}}">सूचना </a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ सूचना थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">सूचना </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">सूचना थप्नुहोस्</h4>
                        <a href="{{route('admin.notice.index',$type)}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सूचना सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.notice.store',$type)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input
                                            type="text"
                                            name="title"
                                            value="{{old('title')}}"
                                            class="form-control @error('title') is-invalid @enderror"
                                            id="title"
                                            placeholder="शिर्षक "
                                            required
                                    />
                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <x-date-input-component
                                            label-ne="मिति *" name-ne="date"
                                    />
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="description" class="form-label">बिवरण </label>
                                    <textarea name="description" id="description" placeholder="बिवरण"
                                              class="form-control summernote" cols="30"
                                              rows="5">{{old('description')}}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label for="files" class="form-label">फाईल </label>
                                    <input
                                            type="file"
                                            name="files[]"
                                            class="form-control @error('files') is-invalid @enderror"
                                            id="files"

                                            multiple/>
                                    @error('files')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @error('files.*')
                                    <div class="invalid-feedback">{{$message}}</div>
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
