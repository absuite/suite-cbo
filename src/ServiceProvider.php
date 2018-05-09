<?php

namespace Suite\Cbo;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Packager;

class ServiceProvider extends BaseServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
		$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
		Packager::loadDatabasesFrom(__DIR__ . '/../database/');
		if ($this->app->runningInConsole()) {
			$publishes = config('gmf.publishes', 'gmf');

			$this->publishes([
				__DIR__ . '/../resources/assets/js' => base_path('resources/assets/js/vendor/suite-cbo'),
			], $publishes);

			$this->publishes([
				__DIR__ . '/../resources/public' => public_path('assets/vendor/suite-cbo'),
			], $publishes);
		}
	}
	public function alias() {
		return 'suite-cbo';
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
	}
}
