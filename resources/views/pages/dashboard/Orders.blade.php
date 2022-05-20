@extends('layouts.dashboard-layout')

@section('content')
<div class="tabs flex justify-center py-5">
    <a href="/dashboard/orders?status=1" class="tab tab-bordered {{ app('request')->input('status') == 1  ? 'tab-active' : ''}}">Pending Orders</a> 
    <a href="/dashboard/orders?status=2" class="tab tab-bordered {{ app('request')->input('status') == 2  ? 'tab-active' : ''}}">On-way Orders</a> 
    <a href="/dashboard/orders?status=3" class="tab tab-bordered {{ app('request')->input('status') == 3  ? 'tab-active' : ''}}">Recieved Orders</a>
</div>

@if ($orders->count() == 0)
<h1 class="mt-20 text-center text-3xl font-light">No orders available</h1>
@else
<div class="overflow-x-auto">
    <table class="table w-full">
    <thead>
        <tr>
            <th>Order id</th>
            <th>since</th>
            <th>Total cost</th>
            <th>Datails</th>
        </tr>
    </thead>  
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <th># {{$order->id}}</th>
                <td>{{$order->created_at->toDateString()}}</td>
                <td>$ {{$order->total}}</td>
                <td><a href="/dashboard/order/details/{{$order->id}}" class="btn btn-outline">Details</a></td>
            </tr>            
        @endforeach
    </tbody>
    </table>
  </div>

@endif

@endsection