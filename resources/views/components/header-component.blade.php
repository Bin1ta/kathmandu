<div class="main-heading">
    <h2 class="sub-title mb-1 mt-3 px-5 fw-bold ">
        @foreach($headers as $header)
        @if($loop->first)
        <span style="color: {{$header->font_color}}; font-size: {{$header->font_size }}px !important;">{{$header->title}}</span>
    @else
        <span class="d-block" style="color: {{$header->font_color}}; font-size: {{$header->font_size}}px !important;">{{$header->title}}</span>
    @endif
        @endforeach

        </h2>

</div>
