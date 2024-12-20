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
                        <a href="{{ route('admin.hallProgram.index') }}">हल कार्यक्रम सूची</a>
                    </li>
                    <li class="breadcrumb-item active">हल कार्यक्रम विवरण</li>
                </ol>
            </div>
            <h4 class="page-title">हल कार्यक्रम विवरण</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">हल कार्यक्रम विवरण</h4>
                    <a href="{{ route('admin.hallProgram.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> सुची
                    </a>
                </div>
            </div>
            <div class="card-body">
                <fieldset class="border p-2 mb-2 d-flex gap-1 ">
                    <legend class="font-16 text-info">
                        <strong>हल कार्यक्रम विवरण </strong>
                    </legend>
                    <div class="row">
                        <div class="col-md-6 mb-2 d-flex gap-1 ">
                            <label class="form-label">कार्यक्रम आयोजकको  नाम:          </label>
                            <p>{{ $hallProgram->program_name }}</p>
                        </div>
                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">कार्यक्रम मिति:</label>
                            <p>{{ $hallProgram->program_date }}</p>
                        </div>
                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">कार्यक्रम हुने समय (देखि): </label>
                            <p>{{ $hallProgram->program_time_to }}</p>
                        </div>
                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">कार्यक्रम हुने समय (सम्म):</label>
                            <p>{{ $hallProgram->program_time_from }}</p>
                        </div>

                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">समावेश वडाहरु:</label>
                            <p>{{ implode(', ', $hallProgram->ward ?? []) }}</p>
                        </div>
                        <div class="col-md-6 mb-2 d-flex gap-1">
                            <label class="form-label">पालिका मा देखाइएको:</label>
                            <p>{{ $hallProgram->is_displayed ? 'हो' : 'होइन' }}</p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label"><strong>कार्यक्रमको विवरण:</strong></label>
                            <p>{{ $hallProgram->program_detail }}</p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label"><strong>कैफियत :</strong></label>
                            <p>{{ $hallProgram->remarks }}</p>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
@endsection
