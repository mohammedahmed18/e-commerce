@extends('layouts.Dashboard-layout')


@section('content')

{!! Form::open(['url' => '/product' ,'method' => 'POST', 'enctype' => 'multipart/form-data','files' => 'true']) !!}
<div class="form-control justify-between flex flex-col p-3 md:p-7 h-auto md:h-screen text-md md:text-lg overflow-y-auto">
  <div class="mx-auto mb-4 font-bold text-2xl">RELEASE A NEW PRODUCT</div>
 {{-- errors --}}
  @if (session('error'))
        <div class="alert shadow-lg alert-error my-3">
            {{ session('error') }}
        </div>
  @endif

  @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert shadow-lg alert-error my-3">
                  {{ $error }}
              </div>
            @endforeach
  @endif

  <label class="input-group shadow-md my-2">
          <span class="bg-accent text-white">Product Name</span>
          {{Form::text('p_name', '',['class' => 'input input-bordered flex-1'])}}
        </label>
    
        
        <label class="input-group shadow-md my-2">
            <span class="bg-accent text-white">Product Description</span>
          {{Form::textarea('p_description', '',['class' => 'textarea flex-1'])}}
          </label>

          <div class="grid grid-rows-1 grid-cols-1 md:grid-cols-2 gap-4 my-2">
              
        <label class="input-group shadow-md">
            <span class="bg-accent text-white">Price (USD)</span>
              {{Form::number('p_price','',['class' => "input input-bordered flex-1" , 'max' => "100000","step"=>".01"])}}
              </label>
              <label class="input-group shadow-md">
                <span class="bg-accent text-white">Stock</span>
                  {{Form::number('p_stock','',['class' => "input input-bordered flex-1",'max' => "100000"])}}
            </label>
          </div>

          <label class="input-group shadow-md my-2 float-left mr-auto w-auto">
            <span class="bg-accent text-white">Categories</span>
            <select class="select select-bordered w-auto select-lg" id="select-categories">
              <option disabled selected>Select categories</option>
              @foreach ($categories as $category)
                  <option>{{$category->name}}</option>
              @endforeach
            </select>
          </label>
          <div id="categories-list" class="flex flex-wrap my-4"></div>              
          <input name="categories" id="categories" type="text" hidden/>
          <label class="text-primary">Upload up to 4 images</label>
          @include('inc.files-input')
      {{Form::submit('Publish !' , ['class' => 'btn btn-success text-white rounded-full float-left mr-auto text-lg my-4'])}}

  </div>
{!! Form::close() !!}


@endsection