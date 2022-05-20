@extends('layouts.dashboard-layout')

@section('content')
  <div class="mb-3 xl:w-96 mx-auto my-4">
    {!! Form::open(['url' => '/dashboard/users' , 'class' => 'w-full md:w-1/2' , 'method' => 'GET']) !!}

    <div class="input-group relative flex items-stretch w-full mb-4">
    
      <input type="search" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="user">
      <button type="submit" class="btn btn-accent" type="button" id="button-addon2">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
        </svg>
      </button>
    </div>
    {!! Form::close() !!}

  </div>

  <div class="overflow-x-auto">
    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>email</th>
          <th>block</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
            <td></td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if ($user->blocked)
                    <button onclick="toggleBlock({{$user->id}})" class="btn btn-outline">Un Block</button>
                @else
                     <button onclick="toggleBlock({{$user->id}})" class="btn btn-error">Block</button>
                @endif
            </td>
        
        </tr>            
        @endforeach

        
      </tbody>
    </table>
  </div>
@endsection