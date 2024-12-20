@extends('frontend.layouts.master')
@section('content')
    <main>
        <section>
            <x-frontend.scroll-news-component />
        </section>
        <section class="notice mt-1">
            <div class="row">
                <div class="col-md-8">
                    <div>
                        <h2 class="heading text-white px-1 text-center">हल कार्यक्रमहरु</h2>
                        {{-- <x-frontend.citizen-charter-component /> --}}
                        <x-frontend.hall-program-component />
                    </div>
                    <div class="table-2">
                        <h2 class="heading">करका दायराहरु</h2>
                        <x-frontend.revenue-component />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="video-container">
                            <x-frontend.digital-board-video-component />
                        </div>
                        <div>
                            <div class="sub-heading mb-1">
                                <h6 class="text-white px-1 mb-0 text-center">कार्यक्रमहरु</h6>
                            </div>
                            <x-frontend.program-component />
                        </div>
                        <div class="mt-1">
                            <div class="sub-heading mb-1">
                                <h6 class="text-center px-1 text-white mb-0">जिम्मेवार पदाधिकारी/कर्मचारी</h6>
                            </div>
                            <x-frontend.employee-section-component />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
