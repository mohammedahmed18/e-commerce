@extends('layouts.dashboard-layout')

@section('content')
    
<div class="flex flex-col flex-wrap overflow-y-auto p-5 items-center">
    {{--avatar ----------------------------------------------------------}}
    {!! Form::open(['url' => '/avatar' ,'class'=>'w-full flex flex-col items-center', 'files' => 'true']) !!}
    <img class="w-40 h-40 md:w-80 md:h-80 object-cover mx-auto rounded-full ring ring-offset-8 my-4"
    src={{$admin->avatar ? "/images/avatars/".$admin->avatar->title : "/images/avatar.jpg" }}
    alt="profile picture"
  />    
    <label class="cursor-pointer my-4 btn btn-outline">
        <i class="fa fa-camera mr-2"></i> 
        <span>change avatar</span>
        <input type="file"
            id="avatar" name="avatar"
            accept="image/png, image/jpeg"
            class="hidden"
            onchange="form.submit()">
         </label>
    {!! Form::close() !!}

    {{-- ----------------------------------------------------------------- --}}
    @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert shadow-lg alert-error my-3">
          {{ $error }}
      </div>
    @endforeach
 @endif

 @if (session('error'))
 <div class="alert shadow-lg alert-error my-3">
     {{ session('error') }}
 </div>
  @endif
          <p class="italic text-2xl">{{$admin->name}}</p>
          <p class="italic text-xl text-gray-600">@ {{$admin->username}}</p>
          {!! Form::open(['url' => '/changepass' ,'method' => 'PATCH', 'class' => 'w-full md:w-1/2 p-4 shadow-lg mx-auto my-7']) !!}
          <h1 class="my-7 text-2xl">change password</h1>
     

          <label class="input-group my-2">
            <span class="bg-base-200 w-40">old password</span>
            {{Form::password('old_password',['class' => 'input input-bordered flex-1'])}}
            </label>
            
            <label class="input-group my-2">
              <span class="bg-base-200 w-40">New password</span>
            {{Form::password('new_password',['class' => 'input input-bordered flex-1'])}}
            </label>

            <label class="input-group my-2">
                <span class="bg-base-200 w-40">confirm password</span>
              {{Form::password('confirm_new_password',['class' => 'input input-bordered flex-1'])}}
              </label>


            {{Form::submit('change password' , ['class' => 'btn btn-secondary my-4 mr-auto font-bold rounded-lg'])}}
          {!! Form::close() !!}
          <h1 class="font-bold my-4  text-4xl">Products added by you</h1>
           @include('inc.productsTable')
  </div>

@endsection