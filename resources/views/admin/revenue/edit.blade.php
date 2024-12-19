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
                            <a href="{{ route('admin.revenue.index') }}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ राजस्व थप्नुहोस्</li>
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
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ राजस्व थप्नुहोस्</h4>
                        <a href="{{ route('admin.revenue.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.revenue.update',$revenue) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="particulars">विवरण</label>
                                    <textarea id="particulars" class="form-control" name="particulars" cols="30"
                                              rows="10">{{old('particulars',$revenue->particulars)}}</textarea>
                                    @error('particulars')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="amount">रकम</label>
                                    <textarea id="amount" class="form-control" name="amount" cols="30"
                                              rows="10">{{old('amount',$revenue->amount)}}</textarea>
                                    @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="remarks">कैफियत</label>
                                    <textarea id="remarks" class="form-control" name="remarks" cols="30"
                                              rows="10">{{old('remarks',$revenue->remarks)}}</textarea>
                                    @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
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

                </div>

            </div>
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </form>

        </div>
    </div>
    </div>
@endsection
