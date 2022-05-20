@extends('layouts.app-layout');
@section('title' , 'sign-up')
@section('theme','light')

    
@section('content')
 <div class="h-screen bg-white flex flex-col md:flex-row justify-center items-center">
  <div class="w-1/2 h-full flex flex-col items-center justify-center bg-white">
    <img src="{{ asset('/svg/signin.svg') }}" alt="">
  </div>
     <div class="flex-1 py-5 rounded-lg flex flex-col items-center w-full">
    {!! Form::open(['url' => '/login' , 'class' => 'w-full']) !!}
    <h1 class="text-center text-4xl font-bold">Log <span class="text-primary">In</span></h1>
    <div class="form-control my-10 p-3 px-7 h-full">
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


            <label class="input-group my-2">
                <span class="bg-base-200 w-40">Email</span>
              {{Form::email('email',null,['class' => 'input input-bordered flex-1'])}}
            </label>
            
            <label class="input-group my-2">
                <span class="bg-base-200 w-40">Password</span>
              {{Form::password('password',['class' => 'input input-bordered flex-1'])}}
            </label>
            
            <div class="flex items-center">
                <span>Remember me </span> {{ Form::checkbox('rememberMe',null,false,['class'=>'checkbox my-2 ml-5']) }}
            </div>
             
            <input name="redirect" value="{{$redirect}}" hidden/>
           {{Form::submit('Log in' , ['class' => 'btn btn-primary my-4 rounded-lg float-left mx-auto btn-lg'])}}
      </div>
    {!! Form::close() !!}
</div>


 </div>
@endsection