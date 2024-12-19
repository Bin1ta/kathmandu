<div class="background"
     style="background-image: url('{{ officeSetting()->background_image_url ?? asset('images/bg.png') }}')">
    <div class="container-fluid d-lg-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center d-none d-sm-block">
            <a href="{{ route('welcome') }}" class="main-logo">
                <img alt="nepal-government-logo" class="logo img-responsive center-block d-block mx-auto"
                     src="{{ asset('assets/frontend/image/logo.png') }}"/>
            </a>
        </div>
        <div class="d-flex text-center justify-content-center align-items-center">
            <x-header-component :ward="$ward ?? null"/>
        </div>
        <div class="d-flex align-items-end flex-column d-none d-sm-block">
            <div>
                <a href="{{ route('welcome') }}" class="main-logo d-flex align-items-center">
                    <span class="link-btn">
                        <i class="fa-solid fa-phone" href="tel:{{ officeSetting($ward ?? null)?->phone }}"></i> - {{ officeSetting($ward ?? null)?->phone }}<br>
                        <i class="fa-solid fa-envelope"></i> - {{ officeSetting($ward ?? null)?->email }}<br>
                        <i class="fa-solid fa-calendar"></i> <span class="mukta fw-bold"><x-top-bar-date-component/></span><br>
                        <i class="fa-solid fa-clock"></i> <span id="clock" class="mukta fw-bold"></span>
                    </span>
                    @if (empty(request('ward')))
                        {{-- <img alt="nepal-flag" class="logo img-responsive center-block"
                             src="{{ asset('images/kmc-logo.png') }}"/> --}}
                    @endif
                    <img alt="nepal-flag" class="logo img-responsive center-block ms-2 "
                         src="{{ asset('assets/frontend/image/nepal_flag.gif') }}"/>
                </a>
            </div>
            {{-- <div>
                @if (empty(request('ward')))
                    <img alt="nepal-flag" class="newari-img img-responsive center-block  mx-auto"
                        src="{{ asset('images/newari.png') }}" />
                @else
                    <a class="link-btn mt-2" href="tel:{{ officeSetting($ward ?? null)?->phone }}">
                        फोन नं - {{ officeSetting($ward ?? null)?->phone }}
                    </a>
                @endif
            </div> --}}

        </div>
    </div>

    {{-- <div class="bg-overlay"></div> --}}
</div>
@push('scripts')
    <script>
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();
            const ampm = hours >= 12 ? 'PM' : 'AM';

            // Convert to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12; // The hour '0' should be '12' in 12-hour clock

            // Add leading zero if necessary
            hours = hours < 10 ? "0" + hours : hours;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            document.getElementById("clock").innerText = hours + ":" + minutes + ":" + seconds + " " + ampm;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);

        // Initial call to display the clock immediately
        updateClock();
    </script>
@endpush
