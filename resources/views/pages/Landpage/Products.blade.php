@extends('layouts.app-layout')


@if ($category)
@section('title',"$category")
@else
@section('title',"Products")
@endif


@section('content')
<div class="mt-40 w-full">



<h1 class="divider text-center text-5xl mt-20 font-bold text-gray-600" id="content">{{$category}}</h1>
<div class="flex flex-col md:flex-row mt-10">
{{--  --}}
<div class="w-full md:w-1/3">
  {!! Form::open(['url' => '/search' , 'class' => 'mx-5 shadow-lg p-3 bg-gray-50 rounded-md']) !!}
  @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-error my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{$error}}</span>
                </div>
            @endforeach
  @endif

  @if (session('error'))
  <div class="alert shadow-lg alert-error my-3">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>{{session("error")}}</span>
  </div>
@endif

    <div class="form-group mb-6 grid">
      <label for="from" class="form-label inline-block mb-2 text-gray-700">From</label>
      <input type="number" class="input input-bordered " id="from" name="from" min="0" step=".01"/>
    </div>
    <div class="form-group mb-6 grid">
      <label for="to" class="form-label inline-block mb-2 text-gray-700">To</label>
      <input type="number" class="input input-bordered" id="to" name="to" min="0" step=".01"/>
    </div>
    <div class="form-group form-check mb-6 grid">
      <label class="inline-block text-gray-700 mb-2" for="category">Category</label>
      <select class="select select-bordered" name="category">
        <option disabled selected>Select a category</option>
        @foreach ($categories as $cat)
            @if ($cat->name == $category)
            <option selected>{{$cat->name}}</option>
            @else
            <option>{{$cat->name}}</option>
            @endif
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
    {!! Form::close() !!}

</div>



@if ($pages == 0)
{{-- no products --}}
<div class="hero p-10 bg-gray-50 h-screen">
  <div class="hero-content text-center">
    <div class="max-w-md">
      <h1 class="text-7xl font-light">No products to display</h1>
    </div>
  </div>
</div>
@else
@include('inc.productsgrid')

@endif

</div>

@if ($pages > 1)
<div class="btn-group my-7 flex justify-center">
  <a href="/products?category={{$category_id}}&page={{$current_page - 1}}#content" class="btn text-lg {{$current_page==1?'btn-disabled':''}}">«</a>
  <button class="btn text-lg">{{$current_page}} of {{$pages}}</button>
  <a href="/products?category={{$category_id}}&page={{$current_page + 1}}#content" class="btn text-lg {{$current_page==$pages?'btn-disabled':''}}">»</a>
</div>
@endif





</div>
@endsection