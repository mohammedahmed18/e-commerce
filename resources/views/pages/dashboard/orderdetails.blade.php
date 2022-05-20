@extends('layouts.dashboard-layout')

@section('content')
<div class="h-full flex justify-center items-center">
    <div class="bg-base-300/25 flex flex-col w-full md:w-9/12 rounded-lg shadow-md p-7">
        <div class="flex flex-col">
            <h1 class="text-2xl my-2 font-bold">order number : #{{$order->id}}</h1>
            {{-- status --}}
            @if ($order->status == 1)
            <span class="badge badge-warning">Pending</span>
            @elseif($order->status == 2)
            <span class="badge badge-info">On way</span>
            @elseif($order->status == 3)
            <span class="badge badge-success">Recieved</span>
            @endif
            <span class="mt-2"><span class="badge mx-2">By :</span>{{$user->name}} <span class="badge mx-2">At :</span> {{$order->address}}</span>
        </div>
        {{-- order items --}}
        <div class="overflow-x-auto my-4">
            <table class="table w-full">
                <thead>
                    <tr>
                      <th>Item image</th>
                      <th>Item Name</th>
                      <th>Item quantity</th>
                    </tr>
                  </thead>
              <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><img class="w-40 h-40 object-cover" src="/images/stock/{{$item->product->images->first()->image_name}}"/></td>
                    <td class="text-2xl">{{$item->product->name}}</td>
                    <td class="text-2xl">{{$item->quantity}}</td>
                </tr>    
                @endforeach
              </tbody>
            </table>
        </div>
        {{-- total price --}}
        <div class="text-2xl font-light">
            <span class="mr-3">Total : </span>
            <span>$ {{$order->total}}</span>
        </div>


        <div class="flex justify-between items-center w-full">

        @if ($order->status == 1)
        {!! Form::open(['url' => '/approve-order/'.$order->id , 'class' => 'my-4' , 'method' => 'PATCH']) !!}
          <button type="submit" class="btn btn-primary">Approve</button>
        {!! Form::close() !!}
        @endif

        @if ($order->status == 2)
        {!! Form::open(['url' => '/arrive-order/'.$order->id , 'class' => 'my-4' , 'method' => 'PATCH']) !!}
            <button type="submit" class="btn btn-success text-gray-100">Arrived</button>
        {!! Form::close() !!}
        @endif
        {{-- cancel order --}}
            

    </div>

    </div>
</div>
@endsection