<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as MiddlewareVerifyCsrfToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/* Create Custom VerifyCsrfToken */
class VerifyCsrfToken extends MiddlewareVerifyCsrfToken
{
    protected $except = [
        'api/*',
    ];
}
