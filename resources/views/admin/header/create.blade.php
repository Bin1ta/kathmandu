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
                            <a href="{{ route('admin.header.index') }}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ हेडर थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">हेडर</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ हेडर थप्नुहोस्</h4>
                        <a href="{{ route('admin.header.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.header.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>हेडर विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">शिर्षक </label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="शिर्षक"/>
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="font" class="form-label">फन्ट </label>
                                    <input type="text" name="font" value="{{ old('font') }}"
                                           class="form-control @error('font') is-invalid @enderror" id="font"
                                           placeholder="फन्ट"/>
                                    @error('font')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="font_size" class="form-label">फन्ट साइज (rem) </label>
                                    <input type="text" step="0.01" min="0" name="font_size" value="{{ old('font_size') }}"
                                           class="form-control @error('font_size') is-invalid @enderror" id="font_size"
                                           placeholder="फन्ट साइज "/>
                                    @error('font_size')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="position" class="form-label">स्थान </label>
                                    <input type="number" min="0" name="position" value="{{ old('position') }}"
                                           class="form-control @error('position') is-invalid @enderror" id="position"
                                           placeholder="स्थान"/>
                                    @error('position')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="font_color" class="form-label">फन्ट रङ </label>
                                    <input type="color" name="font_color" value="{{ old('font_color') }}"
                                           class="form-control @error('font_color') is-invalid @enderror"
                                           id="font_color"
                                           placeholder="फन्ट रङ"/>
                                    @error('font_color')
                                    <p class="text-danger">{{ $message }}</p>
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
@endsection
