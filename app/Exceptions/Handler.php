<?php

namespace App\Exceptions;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function report(Throwable $e)
    {
        if ($e instanceof ValidationException) {
            $errors = $e->validator->errors();
            collect($errors->messages()['email'])->each(function ($error){
                if($error === "Користувач з такою почтою вже зареєстрованний"){
                    Log::channel('custom')->info('[email] ' . request()->input('email') . ' [message] Користувач з такою почтою вже зареєестрованний');
                }
            });

        }

        parent::report($e);
    }
}
