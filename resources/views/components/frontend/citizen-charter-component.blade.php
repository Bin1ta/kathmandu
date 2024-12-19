<table class="table bg-red table-bordered border-danger mb-0">
    <thead>
        <tr>
            <th width="5%">क्र.सं.</th>
            @if (!empty($ward))
                <th scope="col">शाखा</th>
            @endif

            <th width="10%">सेवा</th>
            <th width="55%">आवश्यक कागजातहरु</th>
            <th width="15%">सेवा शुल्क</th>
            <th width="15%">लाग्ने समय</th>
            @if (!empty($ward))
                <th scope="col">जिम्मेवार व्यक्ति</th>
            @endif

        </tr>
    </thead>
</table>
<div id="scroll">
    <table class="table table-success table-bordered">
        <tbody class="align-top">
            @foreach ($citizenCharters as $citizenCharter)
                <tr>
                    <th class="text-start" width="6%">{{ get_nepali_number($loop->iteration) }}</th>
                    @if (!empty($ward))
                        <td>{{ $citizenCharter->branch?->title ?? '' }}</td>
                    @endif
                    <td class="text-start" width="10%">{{ $citizenCharter->service }}</td>
                    <td class="text-start" width="55%">
                        {!! nl2br(e($citizenCharter->required_document)) !!}
                    </td>
                    <td class="text-start" width="15%">{{ $citizenCharter->amount }}</td>
                    <td class="text-start" width="15%">{{ $citizenCharter->time }}</td>
                    @if (!empty($ward))
                        <td class="text-start">{{ $citizenCharter->responsible_person }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
    <script type="text/javascript">
        (function($) {
            $(function() {
                $("#scroll").simplyScroll({
                    customClass: 'vert',
                    orientation: 'vertical',
                    auto: true,
                    manualMode: 'loop',
                    frameRate: 20,
                    speed: 1
                });
            });
        })(jQuery);
    </script>
@endpush
