<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>eBUPF</title>
    

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet"> --}}


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/BU-logo.png') }}" type="image/x-icon">

    
</head>

<body class="p-0 m-0 border-0 overflow-x-hidden">

    
    {{---------------------------------------
        MAke sure that this two components have identical links and assets being used.
     -------------------------------------}}
    @include('member-components.member-layout-offcanvas')
    @include('member-components.member-layout-inPageSidebar')


        <!-- MAIN CONTENT GOES HERE -->
        <div class="col m-0 scrollable-content">

            @yield('content')
        </div>

    </div>



</body>

</html>
