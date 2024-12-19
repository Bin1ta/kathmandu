<div class="row">
    <div class="col-md-6">
        <div class="owl-carousel">

            @foreach ($representatives as $representative)
                <div>
                    <div class="sub-head">
                        <h6 class="text-white mb-0 ">{{ $representative->designation }}</h6>
                    </div>
                    <div class="card mt-1">
                        <img src="{{ $representative->photo_url }}" class="card-img-top" alt="{{ $representative->name }}">
                        <div class="card-body text-center">
                            <h6 class="card-title">
                                {{ $representative->name }}</h6>
                            <h6 class="card-text"><i class="fa fa-phone"></i>
                                {{ $representative->phone }} </h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-6">
        <div class="owl-carousel">
            @foreach ($employees as $employee)
                <div>
                    <div class="sub-head">
                        <h6 class="text-white mb-0 ">{{ $employee->designation }}</h6>
                    </div>
                    <div class="card mt-1">
                        <img src="{{ $employee->photo_url }}" class="card-img-top" alt="{{ $employee->name }}">
                        <div class="card-body text-center">
                            <h6 class="card-title">
                                {{ $employee->name }}</h6>
                            <h6 class="card-text"><i class="fa fa-phone"></i>
                                {{ $employee->phone }} </h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
