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
                        <a class="btn btn-info btn-sm" href="{{ route('admin.popUpSetting.index') }}">
                            पप अप सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.popUpSetting.update',$popUpSetting) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>PopUp विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label mt-2">शिर्षक *</label>
                                    <input type="text" name="title" value="{{ old('title', $popUpSetting->title) }}"
                                        class="form-control mt-2 @error('title') is-invalid @enderror" id="title"
                                        required />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6 mb-2">
                                    <label for="image" class="form-label">
                                        फोटो *
                                    </label>

                                    <input type="file" id="image" name="image" class="form-control"
                                        placeholder="PopUpimage">

                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div> --}}

                                <div class="col-md-6 mb-2">
                                    <label for="image" class="form-label">
                                        फोटो *
                                    </label>
                                    <span>
                                        <img src="{{ $popUpSetting?->image_url }}" height="50" alt="">
                                    </span>
                                    <input type="file" id="image" name="image" class="form-control"
                                        placeholder="PopUpimage">

                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>




                                <div class="col-md-6 mb-2">
                                    <label for="display_duration" class="form-label mt-2">पप-आप देखाउने समय *</label>
                                    <input type="number" step="0.01" name="display_duration"
                                        value="{{ old('display_duration',$popUpSetting->display_duration) }}"
                                        class="form-control mt-2 @error('display_duration') is-invalid @enderror"
                                        id="display_duration" placeholder="पप-आप देखाउने समय" />
                                    @error('display_duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="iteration_duration" class="form-label mt-2">पप-आप फिर्ता हुने समय
                                        *</label>
                                    <input type="number" step="0.01" name="iteration_duration"
                                        value="{{ old('iteration_duration',$popUpSetting->iteration_duration) }}"
                                        class="form-control mt-2 @error('iteration_duration') is-invalid @enderror"
                                        id="iteration_duration" placeholder="पप-आप फिर्ता हुने समय" />
                                    @error('iteration_duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="ward" class="form-label">वडा</label>
                                    <select name="ward[]" id="ward" class="form-select"
                                        @if (!empty(auth()->user()->ward_no)) disabled @endif multiple>
                                        <option value="">---वडा छान्नुहोस्---</option>
                                        @foreach (officeSetting()->localbody->ward_no ??[] as $ward)
                                            <option value="{{ $ward }}"

                                                {{ in_array($ward, old('ward', $popUpSetting->ward)) ? 'selected' : '' }}>
                                                {{ $ward }}</option>
                                        @endforeach
                                    </select>
                                    @error('ward')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('ward.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-2">
                                    <input type="checkbox" name="is_displayed" value="1"
                                           class="form-check-input @error('is_displayed') is-invalid @enderror"
                                           id="is_displayed"
                                           @if (!empty(auth()->user()->ward_no)) disabled @endif
                                           @if (old('is_displayed', $popUpSetting->is_displayed) == 1) checked @endif />
                                    <label for="is_displayed" class="form-label">पालिकामा पनि देखाउनु होस्</label>

                                    @error('is_displayed')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
    @push('scripts')
        <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
    @endpush
@endsection
