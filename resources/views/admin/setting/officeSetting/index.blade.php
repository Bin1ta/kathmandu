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
                            <a href="{{ route('admin.systemSetting.officeSetting.index') }}">कार्यालय सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">कार्यालय सेटिङ सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">कार्यालय सेटिङ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">कार्यालय सेटिङ</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.systemSetting.officeSetting.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset class="mb-2">
                            <legend>कार्यालय बिवरण</legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="form-label">नाम *</label>
                                    <input type="text" name="name"
                                        value="{{ old('name', optional($officeSetting)->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="नाम" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="site_address" class="form-label">ठेगाना *</label>
                                    <input type="text" name="site_address"
                                        value="{{ old('site_address', optional($officeSetting)->site_address) }}"
                                        class="form-control @error('site_address') is-invalid @enderror" id="site_address"
                                        placeholder="ठेगाना" />
                                    @error('site_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>ठेगाना सेटअप</legend>
                            @livewire('address-livewire', ['address' => array_merge(optional($officeSetting)->address ?? [], optional($officeSetting)->ward ?? [])])
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>कार्यालय लोगो</legend>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="logo" class="form-label">फोटो * </label>
                                    <input type="file" name="logo"
                                        class="form-control @error('logo') is-invalid @enderror" id="logo" />
                                    {{-- <img src="{{$officeSetting->logo_url}}" height="60" alt="">
                                    @error('logo')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror --}}
                                    @if ($officeSetting && $officeSetting->logo_url)
                                        <img src="{{ $officeSetting->logo_url }}" height="60" alt="">
                                    @endif
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="logo1" class="form-label">लोगो १</label>
                                    <input type="file" id="logo1" name="logo1" class="form-control" placeholder="logo1">
                                    @if(!empty($officeSetting->logo1))
                                        <img src="{{ $officeSetting->logo1_url }}" height="60" alt="">
                                    @endif
{{--                                    @if ($officeSetting && $officeSetting->logo1_url)--}}
{{--                                        <img src="{{ $officeSetting->logo1_url }}" height="60" alt="">--}}
{{--                                    @endif--}}
                                    @error('logo1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="logo2" class="form-label">लोगो ३ </label>
                                    <input type="file" name="logo2"
                                        class="form-control @error('logo2') is-invalid @enderror" id="logo2" />
                                    {{-- <img src="{{ $officeSetting->logo2_url }}" height="60" alt="">
                                    @error('logo2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                    @if($officeSetting && $officeSetting->logo2_url)
                                    <img src="{{ $officeSetting->logo2_url }}" height="60" alt="">
                                @endif
                                @error('logo2')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                                {{-- <div class="col-md-3 mb-2">
                                    <label for="background_image" class="form-label">पृष्ठभूमि</label>
                                    <input type="file" name="background_image"
                                        class="form-control @error('background_image') is-invalid @enderror"
                                        id="background_image" />
                                    <img src="{{ $officeSetting->background_image_url }}" height="60" alt="">
                                    @error('background_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="col-md-3 mb-2">
                                    <label for="background_image" class="form-label">पृष्ठभूमि</label>
                                    <input type="file" name="background_image"
                                           class="form-control @error('background_image') is-invalid @enderror"
                                           id="background_image" />

                                    @if($officeSetting && $officeSetting->background_image_url)
                                        <img src="{{ $officeSetting->background_image_url }}" height="60" alt="">
                                    @endif

                                    @error('background_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>सम्पर्क जानकारी</legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label">इमेल </label>
                                    <input type="text" name="email" value="{{ old('email', optional($officeSetting)->email) }}"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="इमेल" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="phone" class="form-label">फोन नम्बर </label>
                                    <input type="text" name="phone"
                                        value="{{ old('phone', optional($officeSetting)->phone) }}"
                                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        placeholder="फोन नम्बर" />
                                    @error('phone')
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
