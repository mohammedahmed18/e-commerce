@extends('layouts.Dashboard-layout')


@section('content')

      <div class="flex justify-center items-center h-full flex-col">
        <h1 class="mb-5 text-6xl font-bold">Hello there, {{Auth::guard('admin')->user()->name}}</h1>
        <p class="text-4xl my-3 font-light">New orders : {{$ordersCount}}</p>
        @if ($ordersCount > 0)
            <a class="btn btn-primary my-5" href="/dashboard/orders?status=1">Check orders</a>
        @endif
      </div>

@endsection