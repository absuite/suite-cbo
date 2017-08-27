<?php

namespace Suite\Cbo;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		if ($this->app->runningInConsole()) {
			$this->registerMigrations();

			$publishes = config('gmf.publishes', 'gmf');

			$this->publishes([
				__DIR__ . '/../resources/assets/js' => base_path('resources/assets/js/vendor/suite-cbo'),
			], $publishes);

			$this->publishes([
				__DIR__ . '/../resources/assets/sass' => base_path('resources/assets/sass/vendor/suite-cbo'),
			], $publishes);
		}
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
	}
	/**
	 * Register Passport's migration files.
	 *
	 * @return void
	 */
	protected function registerMigrations() {
		if (Cbo::$runsMigrations) {
			return $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
		}
	}
}
