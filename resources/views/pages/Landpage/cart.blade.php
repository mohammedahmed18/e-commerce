@extends('layouts.app-layout')
@section('title','cart')
@section('content')
<div class="overflow-x-auto mt-40 h-screen flex items-start flex-col lg:flex-row">
  @if ($cartItems->count() == 0)
  <div class="flex flex-col justify-center items-center mx-auto">
    <h1 class="mx-auto mt-20 text-5xl font-light">Your cart is empty</h1>
  </div>
  @else
  <div class="w-full lg:w-7/12">
    <div class="flex justify-between px-10 my-2 bg-gray-50 py-5 mx-2">
      <h1 class="text-4xl">Shopping cart</h1>
      <span class="text-2xl">Items : {{$cartItems->count()}}</span>
    </div>
    <table class="table overflox-x-auto w-full">
      <!-- head -->
 
      <tbody>
          @for ($i = 0; $i < $cartItems->count(); $i++)
            <tr class="mb-3">
                <th>{{$i + 1}}</th>
                <td><img class="w-20 h-20 object-cover" src="/images/stock/{{$products[$i]->images->first()->image_name}}" /></td>
                <td>{{$products[$i]->name}}</td>
                <td>
                    <div class="btn-group">
                        <button onclick="increaseQuantity({{$cartItems[$i]->id}})" class="btn btn-sm bg-base-300 border-none hover:bg-base-300/75 text-gray-600">+</button>
                        <button class="btn btn-sm bg-base-300/50 border-none hover:bg-base-300/50 no-animation text-gray-900">{{$cartItems[$i]->quantity}}</button>
                        <button onclick="decreaseQuantity({{$cartItems[$i]->id}})" class="btn btn-sm bg-base-300 border-none hover:bg-base-300/75 text-gray-600">-</button>
                      </div>
                </td>
                <td>$ {{$products[$i]->price * $cartItems[$i]->quantity}}</td>
                <td>
                  {!! Form::open(['url' => '/remove-cart-item' , 'method' =>'DELETE']) !!}
                  <input hidden name="cartItemId" value="{{$cartItems[$i]->id}}" />  
                  {{Form::submit('Remove' , ['class' => 'link'])}}
                  {!! Form::close() !!}
                </td>
            </tr>              
          @endfor
      </tbody>
    </table>
    
    {{-- continue shopping --}}
    <a href="/products" class="flex font-semibold text-indigo-600 text-sm mt-10 ml-5">
      
      <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
      Continue Shopping
    </a>


  </div>
<div class="flex-1 w-full bg-gray-50 rounded-lg py-5">
  <h1 class="text-center font-bold text-2xl">Your almost there</h1>
  {!! Form::open(['url' => '/order' , 'class' => 'w-full p-10']) !!}
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-error my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{$error}}</span>
                </div>
            @endforeach
        @endif
  <label>Address</label>
  <input name="address" type="text" class="input input-bordered my-2 w-full"/>
  <input hidden value="{{$totalPrice}}" name="total"/>
  <div class="divider"></div>
  <div class="my-6">
    <span class="uppercase text-2xl light mr-5">Total cost : </span>
    <span class="text-2xl light"> <i class="fa fa-dollar"></i> {{$totalPrice}}</span>
  </div>
  <div class="divider"></div>
  <button class="btn btn-block btn-primary btn-lg">Make order</button>
  {!! Form::close() !!}
</div>

@endif

</div>
@endsection