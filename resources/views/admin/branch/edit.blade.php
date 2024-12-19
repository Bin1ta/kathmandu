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
                            <a href="{{ route('admin.branch.index') }}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active"> शाखा सम्पादन थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">शाखा</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">शाखा सम्पादन थप्नुहोस्</h4>
                        <a href="{{ route('admin.branch.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सुची
                        </a>
                    </div>
                </div>




                <div class="card-body">
                    <form action="{{ route('admin.branch.update',$branch) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>शाखा विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">शिर्षक </label>
                                    <input type="text" name="title" value="{{ old('title',$branch->title) }}"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="शिर्षक" />
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="branch_id" class="form-label">शाखा_आईडी </label>
                                    <input type="text" name="branch_id" value="{{ old('branch_id',$branch->branch_id) }}"
                                        class="form-control @error('branch_id') is-invalid @enderror" id="title"
                                        placeholder="शाखा_आईडी" />
                                    @error('branch_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="ward" class="form-label">वडा</label>
                                    <select name="ward[]" id="ward" class="form-select"
                                            @if(!empty(auth()->user()->ward_no)) disabled @endif multiple>
                                        <option value="">---वडा छान्नुहोस्---</option>
                                        @foreach(officeSetting()->localbody->ward_no ??[] as $ward)
                                        <option value="{{ $ward }}"
                                        {{-- {{ in_array($ward, old('ward', !empty(auth()->user()->ward_no))) ? 'selected' : '' }}> --}}
                                        {{ in_array($ward, old('ward', $branch->ward)) ? 'selected' : '' }}>
                                        {{ $ward }}</option>
                                        @endforeach
                                    </select>
                                    @error('ward')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @error('ward.*')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <input
                                        type="checkbox"
                                        name="is_displayed"
                                        value="1"
                                        class="form-check-input @error('is_displayed') is-invalid @enderror"
                                        id="is_displayed"
                                        @if(!empty(auth()->user()->ward_no)) disabled @else checked @endif
                                    />
                                    <label for="is_displayed" class="form-label">पालिकामा पनि देखाउनु होस्</label>

                                    @error('is_displayed')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
