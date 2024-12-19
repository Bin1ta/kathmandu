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
                            <a href="{{route('admin.video.index')}}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active">भिडियो सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">भिडियो</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">भिडियो सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.video.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <form action="{{route('admin.video.update', $video)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">भिडियो शिर्षक </label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title', $video->title)}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="Video Title"
                                    required
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="video" class="form-label">भिडियो</label>
                                <input type="hidden" name="video" value="{{$video->video}}" id="video">
                                @error('video')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                <button type="button" class="btn btn-outline-primary form-control" id="browseFile">
                                    <i class="fa fa-cloud-upload-alt"></i> Upload File
                                </button>
                                <div class="progress mt-3" style="display: none;height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 75%; height: 100%">75%
                                    </div>
                                </div>
                                <div id="video-preview-card" class="mt-2" style="display: none">
                                    <video id="videoPreview" controls style="width: 100%;height: auto;"></video>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form> --}}
                    <form action="{{route('admin.video.update',$video)}}" method="post"
                    enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="row">
                      <div class="col-md-6 mb-2">
                          <label for="title" class="form-label">भिडियो शिर्षक </label>
                          <input
                              type="text"
                              name="title"
                              value="{{old('title', $video->title)}}"
                              class="form-control @error('title') is-invalid @enderror"
                              id="title"
                              placeholder="Video Title"
                              required
                          />
                          @error('title')
                          <div class="invalid-feedback">{{$message}}</div>
                          @enderror
                      </div>
                      <div class="col-md-6 mb-2">
                          <label for="video" class="form-label">भिडियो (यूट्यूब लिंक) * </label>
                          <input type="url" name="video" id="video" required value=  value="{{old('video', $video->video)}}"
                                 class="form-control @error('title') is-invalid @enderror">
                          @error('video')
                          <div class="invalid-feedback">{{$message}}</div>
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

                  <button type="submit" class="btn btn-primary">
                      Save
                  </button>
              </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

        <script type="text/javascript">
            $('#video').val('')
            let browseFile = $('#browseFile');
            let resumable = new Resumable({
                target: '{{ route('admin.fileUpload.chunkStore') }}',
                query: {_token: '{{ csrf_token() }}'},// CSRF token
                fileType: ['mp4'],
                chunkSize: 2 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
                headers: {
                    'Accept': 'application/json'
                },
                testChunks: false,
                throttleProgressCallbacks: 1,
            });

            resumable.assignBrowse(browseFile[0]);

            resumable.on('fileAdded', function (file) { // trigger when file picked
                showProgress();
                resumable.upload() // to actually start uploading.
            });

            resumable.on('fileProgress', function (file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
                response = JSON.parse(response)
                $('#videoPreview').attr('src', response.url);
                $('#video-preview-card').show();
                $('#video').val(response.path)
                hideProgress()
            });

            resumable.on('fileError', function (file, response) { // trigger when there is any error
                alert('file uploading error.')
            });


            let progress = $('.progress');

            function showProgress() {
                progress.find('.progress-bar').css('width', '0%');
                progress.find('.progress-bar').html('0%');
                progress.find('.progress-bar').removeClass('bg-success');
                progress.show();
            }

            function updateProgress(value) {
                progress.find('.progress-bar').css('width', `${value}%`)
                progress.find('.progress-bar').html(`${value}%`)
            }

            function hideProgress() {
                progress.hide();
            }
        </script>
    @endpush
@endsection
