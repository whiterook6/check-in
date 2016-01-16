<?php

namespace Checkin\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class VersionServiceProvider extends ServiceProvider {
	public function boot(Kernel $kernel){
		$kernel->pushMiddleware('Checkin\Middleware\CatchValidationException');
	}

	public function register(){}
}