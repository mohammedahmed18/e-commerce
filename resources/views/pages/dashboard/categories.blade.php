@extends('layouts.dashboard-layout')

@section('content')
        {!! Form::open(['url' => '/category' , 'class' => 'w-full lg:w-1/2 p-4 shadow-lg m-4']) !!}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert shadow-lg alert-error my-3">
                  {{ $error }}
              </div>
            @endforeach
         @endif
        <label class="input-group my-2">
            <span class="bg-base-200 w-40">Category Name</span>
          {{Form::text('category_name', '',['class' => 'input input-bordered flex-1'])}}
          </label>
          <label class="input-group my-2">
            <span class="bg-base-200 w-40">Short Description</span>
          {{Form::text('category_description', '',['class' => 'input input-bordered flex-1'])}}
          </label>
               {{Form::submit('Add' , ['class' => 'btn btn-outline my-4 mr-auto font-bold rounded-r-full'])}}
        {!! Form::close() !!}
<div class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid:cols-6 p-5">
    @foreach ($categories as $cat)
    <div class="card bg-neutral text-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">{{$cat->name}}</h2>
          <p>{{$cat->description}}</p>
          <div class="card-actions justify-end mt-3">
            <a href="/dashboard/category/edit/{{$cat->id}}" class="btn btn-primary">Edit</a>
            @if (Auth::guard("admin")->user()->is_super)
              <button onclick="window.confirmDelete('http://{{Request::getHttpHost()}}/category/{{$cat->id}}', '{{$cat->name}}' , '/dashboard/categories')" class="btn btn-error">Delete</button>
            @endif
          </div>
        </div>
      </div>
        
    @endforeach
</div>
@endsection
