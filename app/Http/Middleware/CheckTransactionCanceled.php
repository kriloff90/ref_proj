<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTransactionCanceled
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('transaction')->canceled) {
            abort(404, 'Transaction is not found');
        }

        return $next($request);
    }
}
