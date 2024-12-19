@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                                <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                     alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.systemSetting.userManagement.user.index')}}">प्रयोगकर्ता
                                व्यवस्थापन</a>
                        </li>
                        <li class="breadcrumb-item active">प्रयोगकर्ता अद्यावधिक गर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">प्रयोगकर्ता</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">प्रयोगकर्ता अद्यावधिक गर्नुहोस</h4>
                        <a href="{{route('admin.systemSetting.userManagement.user.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> प्रयोगकर्ता सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.systemSetting.userManagement.user.update', $user)}}" method="post">
                        @csrf
                        @method('PUT')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>व्यक्तिगत विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="form-label">नाम *</label>
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{old('name', $user->name)}}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        placeholder="नाम"
                                    />
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label">इमेल *</label>
                                    <input
                                        type="text"
                                        name="email"
                                        value="{{old('email', $user->email)}}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        placeholder="इमेल"
                                    />
                                    @error('email')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="phone" class="form-label">फोन नम्बर *</label>
                                    <input
                                        type="text"
                                        name="phone"
                                        value="{{old('phone', $user->phone)}}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="phone"
                                        placeholder="फोन नम्बर"
                                    />
                                    @error('phone')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="role_id" class="form-label">भूमिका *</label>
                                    <select name="role_id"
                                            class="form-select @error('role_id') is-invalid @enderror"
                                            id="role_id">
                                        <option value="">भूमिका छान्नुहोस्</option>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{$role->id}}" {{$role->id==old('role_id', $user->role_id) ? 'selected' : ''}}>
                                                {{$role->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="ward_no" class="form-label">वडा नं.</label>
                                    <select name="ward_no"
                                            class="form-select @error('ward_no') is-invalid @enderror"
                                            id="ward_no">
                                        <option value="">वडा छान्नुहोस्</option>
                                        @foreach(officeSetting()->localBody?->ward_no ??[] as $ward)
                                            <option
                                                value="{{$ward}}" {{$ward==old('ward_no',$user->ward_no) ? 'selected' : ''}}>
                                                {{$ward}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ward_no')
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
