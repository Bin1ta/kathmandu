<div class="news-slider-wrapper">
    <div class="d-flex align-items-center w-100">
        <h2>सूचना</h2>
        <marquee class="w-100" behavior="scroll" scrolldelay="100" scrollamount="6">
            <ul class="d-flex gap-5">
                @foreach($scrollNews as $scrollNew)
                    <li class="mr-5 fs-5">
                        {{$scrollNew->title}}
                    </li>
                @endforeach
            </ul>
        </marquee>
    </div>
</div>
