<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\File\Exception\IniSizeFileException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
      $this->renderable(function(PostTooLargeException $e ,$request){
        return Redirect::back()->with('error', 'maximum upload size is 2 MB')->withInput()->send();

      });

      $this->renderable(function(IniSizeFileException $e ,$request){
        return Redirect::back()->with('error', 'maximum upload size is 2 MB')->withInput();
      });

      
    }
}
