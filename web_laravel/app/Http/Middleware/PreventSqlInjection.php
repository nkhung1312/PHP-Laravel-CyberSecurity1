<?php

namespace App\Http\Middleware;

use Closure;

class PreventSqlInjection
{
    public function handle($request, Closure $next)
    {
        $input = $request->all();

        array_walk_recursive($input, function (&$value) {
            $value = preg_replace('[\'";#]', '', $value); // Loại bỏ các ký tự nguy hiểm
        });

        $request->merge($input);

        return $next($request);
    }
} 
