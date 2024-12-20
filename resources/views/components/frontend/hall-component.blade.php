<table class="table table-bordered table-primary border-primary mb-0">
    <thead>
        <tr>
            <th width="4%">क्र.सं.</th>
            <th width="30%">सेवा</th>
            <th width="25%">कार्यक्रम समय</th>
            <th width="20%">शुल्क</th>
            <th widht="20%"> समय</th>
        </tr>

    </thead>
</table>

<div id="scroll1">
    <table class="table table-success table-bordered">
        <tbody class="align-top">
            @foreach ($halls as $hall)
                <tr>
                    <th class="text-start" width="4%">{{ get_nepali_number($loop->iteration) }}</th>

                    <td class="text-start" width="20%">{{ $hall->service }}</td>
                    <td class="text-start" width="20%">{{ $hall->program_time }}</td>
                    <td class="text-start" width="15%">{{ $hall->rate }}</td>
                    <td class="text-start" width="15%">{{ $hall->time }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
    <script type="text/javascript">
        (function($) {
            $(function() {
                $("#scroll1").simplyScroll({
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
