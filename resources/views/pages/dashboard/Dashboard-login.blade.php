
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <title>Dashboard</title>
</head>
<body>
    
<div class="flex justify-center items-center h-screen bg-base-200">
    <div id="login-section" class="bg-base-300 shadow-lg pt-10 h-4/5 flex justify-center items-center w-96">
        {!! Form::open(['url' => '/dashboard-login' , 'class' => 'w-full']) !!}
        <div class="form-control my-10 p-9 h-full">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{$error}}</span>
                    </div>
                @endforeach
            @endif

                <label class="input-group my-2">
                    <span class="bg-base-200">Username</span>
                  {{Form::text('username', '',['class' => 'input input-bordered flex-1'])}}
                  </label>
    
                <label class="input-group my-2">
                    <span class="bg-base-200">password</span>
                  {{Form::password('password',['class' => 'input input-bordered flex-1'])}}
                  </label>
                  <div class="flex items-center">
                 <span>Remember me </span> {{ Form::checkbox('remember',null,false,['class'=>'checkbox my-2 ml-5']) }}
                </div>
                          
               {{Form::submit('Log in' , ['class' => 'btn btn-primary my-4 w-1/2 mx-auto rounded-lg'])}}
        
          </div>
        {!! Form::close() !!}
    </div>
    </div>
</body>
</html>