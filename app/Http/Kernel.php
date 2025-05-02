<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  /**
   * The application's route middleware.
   *
   * These middleware may be assigned to groups or used individually.
   *
   * @var array<string, class-string|string>
   */
  protected $middlewareAliases = [
    // default aliases
    'auth' => \App\Http\Middleware\Authenticate::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    
    // kamu tambahin ini:
    // 'is_admin' => \App\Http\Middleware\IsAdmin::class,
  ];
}
