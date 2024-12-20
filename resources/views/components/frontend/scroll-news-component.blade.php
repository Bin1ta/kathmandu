<div class="news-slider-wrapper">
    <div class="d-flex align-items-center justify-content-between w-100">
        <h2 class="mr-3" style="white-space: nowrap;">हल विवरण</h2>
        <div class="w-100 overflow-hidden">
            <marquee behavior="scroll" scrolldelay="100" scrollamount="6" class="d-block">
                <ul class="d-flex list-unstyled m-0 gap-4">
                    @foreach($hallDetails as $hallDetail)
                        <li class="fs-5">
                            {{ $hallDetail->title }}
                        </li>
                    @endforeach
                </ul>
            </marquee>
        </div>
    </div>
</div>
