<!DOCTYPE html>
<html lang="en" data-theme="Dashboard" data-mode="dashboard">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <title>Dashboard</title>
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


    <div class="flex flex-col md:flex-row">
        @include('inc.Dashboard-sidebar')
        <div class="w-full md:h-screen opacity-0 overflow-y-auto" id="dashboard-content">
             @yield('content')
        </div>
    </div>  
    
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>