<table class="table bg-red table-bordered border-danger mb-0">
    <thead>
        <tr>
            <th width="4%">क्र.सं.</th>
            <th width="22%">कार्यक्रम आयोजकको नाम</th>
            <th width="25%">कार्यक्रम विवरण</th>
            <th width="15%">कार्यक्रम मिति</th>
            <th colspan="2" width="18%">कार्यक्रम हुने समय</th>
            <th widht="20%"> कैफियत</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th width="9%">देखि </th>
            <th width="9%">सम्म</th>
            <th></th>
        </tr>
    </thead>
</table>

<div id="scroll">
    <table class="table table-success table-bordered">
        <tbody class="align-top">
            @foreach ($hallPrograms as $hallProgram)
                <tr>
                    <th class="text-start" width="5%">{{ get_nepali_number($loop->iteration) }}</th>

                    <td class="text-start" width="22%">{{ $hallProgram->program_name }}</td>
                    <td class="text-start" width="25%">{{ $hallProgram->program_detail }}</td>
                    <td class="text-start" width="15%">{{ $hallProgram->program_date }}</td>

                    <td class="text-start" width="10%">{{ $hallProgram->program_time_to }}</td>
                    <td class="text-start" width="10%">{{ $hallProgram->program_time_from }}</td>
                    <td class="text-start" width="20%">{{ $hallProgram->remarks }}</td>
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
