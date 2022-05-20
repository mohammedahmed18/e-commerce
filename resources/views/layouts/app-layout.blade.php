<!DOCTYPE html>
<html lang="en" data-theme="@yield('theme','winter')">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <title>Shopify - @yield('title')</title>
</head>
<body>

    @if (session('toast-success'))
     <div id="toast" class="toast fixed bg-success right-5 shadow-lg top-20 px-7 py-2">
        <i class="fa-solid fa-circle-check"></i>
        <p>{{session('toast-success')}}</p>
    </div>        
    @elseif(session('toast-info'))
    <div id="toast" class="toast fixed bg-secondary right-5 shadow-lg top-20 px-7 py-2">
        <i class="fa-solid fa-circle-info"></i>
        <p>{{session('toast-info')}}</p>
    </div>
    @elseif(session('toast-error'))
    <div id="toast" class="toast fixed bg-error right-5 shadow-lg top-20 px-7 py-2">
        <i class="fa-solid fa-circle-exclamation"></i>
        <p>{{session('toast-error')}}</p>
    </div>         
    @endif






    @include('inc.navbar')
    <div class="flex flex-col justify-between">
        @yield('content')
        @include('inc.footer')
    </div>

    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>