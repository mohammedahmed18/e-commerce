@extends('layouts.dashboard-layout')

@section('content')
<div class="flex flex-col flex-wrap overflow-y-auto p-5">
<div class="px-9 py-5 flex justify-between">
  <a href="/products/insert" class="bg-accent text-md shadow-lg btn btn-rounded border-0 mr-3">
    <i class="fa fa-plus"></i>
    <span class="font-sans text-lg">Add a new product</span>
  </a>
  {!! Form::open(['url' => '/clear' ,'method' => "DELETE"]) !!}
    <button class="btn">Clear unused Files in the storage</button>
  {!! Form::close() !!}

</div>

<div class="my-5">
  @include('inc.productsTable')
</div>
{{------------------------------------------- pagination-------------------------- --}}
<div class="btn-group mx-auto">
    <a href="/dashboard/products?page={{$current_page - 1}}#dashboard-content" class="btn text-lg {{$current_page==1?'btn-disabled':''}}">«</a>
    <button class="btn text-lg">{{$current_page}} of {{$pages}}</button>
    <a href="/dashboard/products?page={{$current_page + 1}}#dashboard-content" class="btn text-lg {{$current_page==$pages?'btn-disabled':''}}">»</a>
</div>

</div>
@endsection