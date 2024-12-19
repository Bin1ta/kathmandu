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
                            <a href="{{ route('admin.employee.index') }}">कर्मचारी </a>
                        </li>
                        <li class="breadcrumb-item active">सम्पादन थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">कर्मचारीहरु </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">कर्मचारी सम्पादन थप्नुहोस्</h4>
                        <a href="{{ route('admin.employee.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> कर्मचारी सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.employee.update', $employee) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>कर्मचारी विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="form-label">नाम *</label>
                                    <input type="text" name="name" value="{{ old('name', $employee->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="नाम " required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="department" class="form-label">समूह </label>
                                    <input type="text" name="department"
                                        value="{{ old('department', $employee->department) }}"
                                        class="form-control  @error('department') is-invalid @enderror" id="department"
                                        placeholder=" समूह" />
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="employee_id" class="form-label">मथेल्नो तह कर्मचारी </label>

                                    <select class="form-control @error('employee_id') is-invalid @enderror"
                                        name="employee_id" id="employee_id">
                                        <option value="">कर्मचारी छान्नुहोस</option>
                                        @foreach ($allEmployees as $allEmployee)
                                            <option value="{{ $allEmployee->id }}"
                                                {{ old('employee_id', $employee->employee_id) == $allEmployee->id ? 'selected' : '' }}>
                                                {{ $allEmployee->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="designation" class="form-label">पद </label>
                                    <input type="text" name="designation"
                                        value="{{ old('designation', $employee->designation) }}"
                                        class="form-control  @error('designation') is-invalid @enderror" id="designation"
                                        placeholder=" पद" />
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label">इमेल </label>
                                    <input type="text" name="email" value="{{ old('email', $employee->email) }}"
                                        class="form-control  @error('email') is-invalid @enderror" id="email"
                                        placeholder=" इमेल" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="phone" class="form-label">फोन </label>
                                    <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}"
                                        class="form-control  @error('phone') is-invalid @enderror" id="phone"
                                        placeholder=" फोन" />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="photo" class="form-label">फोटो </label>
                                    <input type="file" name="photo"
                                        class="form-control  @error('photo') is-invalid @enderror" id="photo" />
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="position" class="form-label">स्थान </label>
                                    <input type="text" name="position"
                                        value="{{ old('position', $employee->position) }}"
                                        class="form-control @error('position') is-invalid @enderror" id="position"
                                        placeholder=" स्थान" />
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="is_employee" class="form-label">कर्मचारीको प्रकार *</label>

                                    <select class="form-control @error('is_employee') is-invalid @enderror"
                                        name="is_employee" id="is_employee" required>
                                        <option value="1"
                                            {{ old('is_employee', $employee->is_employee) == 1 ? 'selected' : '' }}>
                                            कर्मचारी
                                        </option>
                                        <option value="0"
                                            {{ old('is_employee', $employee->is_employee) == 0 ? 'selected' : '' }}>
                                            जनप्रतिनिधि
                                        </option>
                                    </select>
                                    @error('is_employee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="show_to_index" class="form-label">गृहपृष्ठमा देखाउनुहोस् *</label>

                                    <select class="form-control @error('show_to_index') is-invalid @enderror"
                                        name="show_to_index" id="show_to_index" required>
                                        <option value="1"
                                            {{ old('show_to_index', $employee->show_to_index) == 1 ? 'selected' : '' }}>
                                            देखाउने
                                        </option>
                                        <option value="0"
                                            {{ old('show_to_index', $employee->show_to_index) == 0 ? 'selected' : '' }}>
                                            नदेखाउने
                                        </option>
                                    </select>
                                    @error('show_to_index')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="show_to_mobile_app" class="form-label">मोबाइलमा देखाउनुहोस् *</label>

                                    <select class="form-control @error('show_to_mobile_app') is-invalid @enderror"
                                        name="show_to_mobile_app" id="show_to_mobile_app" required>
                                        <option value="1"
                                            {{ old('show_to_mobile_app', $employee->show_to_mobile_app) == 1 ? 'selected' : '' }}>
                                            देखाउने
                                        </option>
                                        <option value="0"
                                            {{ old('show_to_mobile_app', $employee->show_to_mobile_app) == 0 ? 'selected' : '' }}>
                                            नदेखाउने
                                        </option>
                                    </select>
                                    @error('show_to_mobile_app')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="ward" class="form-label">वडा</label>
                                    <select name="ward[]" id="ward" class="form-select"
                                        @if (!empty(auth()->user()->ward_no)) disabled @endif multiple>
                                        <option value="">---वडा छान्नुहोस्---</option>
                                        @foreach (officeSetting()->localbody->ward_no ??[] as $ward)
                                        <option value="{{ $ward }}"
                                        {{ in_array($ward, old('ward', $employee->ward)) ? 'selected' : '' }}>
                                        {{ $ward }}</option>
                                        @endforeach
                                    @error('ward')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('ward.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <input
                                        type="checkbox"
                                        name="is_displayed"
                                        value="1"
                                        class="form-check-input @error('is_displayed') is-invalid @enderror"
                                        id="is_displayed"
                                        @if(!empty(auth()->user()->ward_no)) disabled  @endif
                                        @if(old('is_displayed')) checked @endif
                                    />
                                    <label for="is_displayed" class="form-label">पालिकामा पनि देखाउनु होस्</label>

                                    @error('is_displayed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
