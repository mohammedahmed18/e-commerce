@extends('layouts.dashboard-layout')

@section('content')
<div class="flex flex-col justify-center items-center h-full">
{!! Form::open(['url' => '/category/edit/'.$category->id , 'class' => 'w-full lg:w-1/2 p-4 shadow-lg m-4','method' => 'PATCH']) !!}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert shadow-lg alert-error my-3">
                  {{ $error }}
              </div>
            @endforeach
         @endif
        <label class="input-group my-2">
            <span class="bg-base-200 w-40">Category Name</span>
          {{Form::text('category_name', $category->name,['class' => 'input input-bordered flex-1'])}}
          </label>
          <label class="input-group my-2">
            <span class="bg-base-200 w-40">Short Description</span>
          {{Form::text('category_description', $category->description,['class' => 'input input-bordered flex-1'])}}
          </label>
               {{Form::submit('Update' , ['class' => 'btn btn-primary my-4 mr-auto font-bold'])}}
        {!! Form::close() !!}
    </div>

@endsection
