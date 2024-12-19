<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>New Ward ktm</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/ward.css') }}"/>
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
<section style="background-color: #e5e5e5;">
    <div class="container">
        <h2 class="ward-title">काठमाडौँ महानगरपालिकाका वडा कार्यालयहरु</h2>
    </div>
    <div class="container">
        @for($i=1;$i<=config('app.ward');$i++)
            <div class="wardcard">
                <a href="{{route('wardIndex', $i)}}">वडा नं
                    <span>{{get_nepali_number($i)}}</span>
                </a>
            </div>
        @endfor
    </div>
</section>
</body>

</html>
