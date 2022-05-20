@extends('layouts.app-layout');
@section('title' , 'sign-up')
@section('theme','light')
@section('content')
 <div class="flex flex-col items-center justify-center h-screen bg-white md:flex-row">
  <div class="flex flex-col items-center justify-center w-1/2 h-full bg-white">
    <img src="{{ asset('/svg/signup.svg') }}" alt="">
  </div>
     <div class="flex flex-col items-center flex-1 w-full py-5 rounded-lg">
    {!! Form::open(['url' => '/signup' , 'class' => 'w-full']) !!}
    <h1 class="text-4xl font-bold text-center">Sign <span class="text-primary">Up</span></h1>
    <div class="h-full p-3 my-10 form-control px-7">
       
      @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="my-2 alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{$error}}</span>
                </div>
            @endforeach
        @endif

        @if (session('error'))
        <div class="my-3 shadow-lg alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{session("error")}}</span>
        </div>
        @endif

            <label class="my-2 input-group">
                <span class="w-40 bg-base-200">Name</span>
              {{Form::text('name', '',['class' => 'input input-bordered flex-1'])}}
            </label>

            <label class="my-2 input-group">
                <span class="w-40 bg-base-200">Email</span>
              {{Form::email('email',null,['class' => 'input input-bordered flex-1'])}}
            </label>
            
            <label class="my-2 input-group">
                <span class="w-40 bg-base-200">Password</span>
              {{Form::password('password',['class' => 'input input-bordered flex-1'])}}
            </label>
            
            <label class="my-2 input-group">
                <span class="w-40 bg-base-200">Confirm Password</span>
              {{Form::password('confirm_password',['class' => 'input input-bordered flex-1'])}}
            </label>
             
                      
           {{Form::submit('Sign up' , ['class' => 'btn btn-primary my-4 rounded-lg float-left mx-auto btn-lg'])}}
      </div>
    {!! Form::close() !!}
</div>


 </div>
@endsection