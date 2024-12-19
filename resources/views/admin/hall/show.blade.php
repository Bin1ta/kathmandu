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
                        <a href="{{ route('admin.hall.index') }}">हल सूची</a>
                    </li>
                    <li class="breadcrumb-item active">हल विवरण</li>
                </ol>
            </div>
            <h4 class="page-title">हल विवरण</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">हल विवरण</h4>
                    <a href="{{ route('admin.hall.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> सुची
                    </a>
                </div>
            </div>
            <div class="card-body">
                <fieldset class="border p-2 mb-2 d-flex gap-1 ">
                    <legend class="font-16 text-info">
                        <strong>हल विवरण </strong>
                    </legend>
                    <div class="row">
                        <div class="col-md-6 mb-2 d-flex gap-1 ">
                            <label class="form-label">सेवा:          </label>
                            <p>{{ $hall->service }}</p>
                        </div>
                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">कार्यक्रम समय:</label>
                            <p>{{ $hall->program_time }}</p>
                        </div>
                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">शुल्क:</label>
                            <p>{{ $hall->rate }}</p>
                        </div>
                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">समय:</label>
                            <p>{{ $hall->time }}</p>
                        </div>

                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">समावेश वडाहरु:</label>
                            <p>{{ implode(', ', $hall->ward ?? []) }}</p>
                        </div>
                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">पालिका मा देखाइएको:</label>
                            <p>{{ $hall->is_displayed ? 'हो' : 'होइन' }}</p>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
@endsection
