<table class="table table-borderless table-primary position-relative overflow-hidden">
    <thead class="sticky-top">
    <tr>
        <th scope="col">क्र.सं.</th>
        <th scope="col">विवरण</th>
        <th scope="col">लाग्ने कर</th>
        <th scope="col">कैफियत</th>
    </tr>
    </thead>
    <tbody class="move">
    @foreach($revenues as $revenue)
        <tr>
            <th scope="row">{{get_nepali_number($loop->iteration)}}</th>
            <td>{{$revenue->particulars ?? ''}}</td>
            <td>{{$revenue->amount}}</td>
            <td>{{$revenue->remarks}}</td>
        </tr>
    @endforeach

    </tbody>
</table>
