<?php

namespace Checkin\Middleware;

use Closure;
use Checkin\Exceptions\ValidationException;

class CatchValidationException {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		try {
			$result = $next($request);
		} catch (ValidationException $e){
			$message = $e->getMessage();
			$validator = $e->validator();

			return response()->invalid($validator, $message);
		}

		return $result;
	}

}