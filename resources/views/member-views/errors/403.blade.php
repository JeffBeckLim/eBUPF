<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Forbidden</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/BU-logo.png') }}" type="image/x-icon">


    {{-- DATA TABLE .NET --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; overflow: hidden;">
        <div class="text-center">
            <p class="lead">
                @if(!is_null($customMessage))
                    <div class="d-flexbox justify-content-center align-items-center">
                        <div>
                            <a href="{{ route('home') }}" class="bu-orange btn text-white fw-bold" style="border-radius: 20px;">Go to dashboard</a>
                        </div>
                        <img src="{{asset('assets/403-error.svg')}}" alt="Error 403" width="75%" height="75%" style="min-width: 350px; min-height: 300px;">
                        <div>
                            <span class="fw-bold" style="color: #555555">{{ $customMessage }}</span>
                        </div>
                    </div>
                @else
                    {{ $default }}
                @endif
            </p>
        </div>
    </div>

</body>
</html>
