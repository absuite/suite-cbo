<?php

namespace Suite\Cbo;

use Illuminate\Contracts\Routing\Registrar as Router;

class RouteRegistrar {
	/**
	 * The router implementation.
	 *
	 * @var Router
	 */
	protected $router;

	/**
	 * Create a new route registrar instance.
	 *
	 * @param  Router  $router
	 * @return void
	 */
	public function __construct(Router $router) {
		$this->router = $router;
	}

	/**
	 * Register routes for transient tokens, clients, and personal access tokens.
	 *
	 * @return void
	 */
	public function all() {
		$this->router->group(['prefix' => 'cbo', 'middleware' => ['api', 'ent_check']], function ($router) {
			$router->post('/orgs/batch', ['uses' => 'OrgController@batchStore']);
			$router->resource('orgs', 'OrgController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/depts/batch', ['uses' => 'DeptController@batchStore']);
			$router->resource('depts', 'DeptController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/works/batch', ['uses' => 'WorkController@batchStore']);
			$router->resource('works', 'WorkController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/teams/batch', ['uses' => 'TeamController@batchStore']);
			$router->resource('teams', 'TeamController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/areas/batch', ['uses' => 'AreaController@batchStore']);
			$router->resource('areas', 'AreaController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/provinces/batch', ['uses' => 'ProvinceController@batchStore']);
			$router->resource('provinces', 'ProvinceController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/countries/batch', ['uses' => 'CountryController@batchStore']);
			$router->resource('countries', 'CountryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/currencies/batch', ['uses' => 'CurrencyController@batchStore']);
			$router->resource('currencies', 'CurrencyController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/teams/batch', ['uses' => 'DivisionController@batchStore']);
			$router->resource('divisions', 'DivisionController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/item-categories/batch', ['uses' => 'ItemCategoryController@batchStore']);
			$router->resource('item-categories', 'ItemCategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/items/batch', ['uses' => 'ItemController@batchStore']);
			$router->resource('items', 'ItemController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/lots/batch', ['uses' => 'LotController@batchStore']);
			$router->resource('lots', 'LotController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/teams/batch', ['uses' => 'MfcCategoryController@batchStore']);
			$router->resource('mfc-categories', 'MfcCategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/mfcs/batch', ['uses' => 'MfcController@batchStore']);
			$router->resource('mfcs', 'MfcController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('period-calendars/{id}/build', ['uses' => 'PeriodCalendarController@build']);
			$router->post('/period-calendars/batch', ['uses' => 'PeriodCalendarController@batchStore']);
			$router->resource('period-calendars', 'PeriodCalendarController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/period-accounts/batch', ['uses' => 'PeriodAccountController@batchStore']);
			$router->resource('period-accounts', 'PeriodAccountController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/doc-types/batch', ['uses' => 'DocTypeController@batchStore']);
			$router->resource('doc-types', 'DocTypeController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/teams/batch', ['uses' => 'PersonController@batchStore']);
			$router->resource('persons', 'PersonController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/project-categories/batch', ['uses' => 'ProjectCategoryController@batchStore']);
			$router->resource('project-categories', 'ProjectCategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/projects/batch', ['uses' => 'ProjectController@batchStore']);
			$router->resource('projects', 'ProjectController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/trader-categories/batch', ['uses' => 'TraderCategoryController@batchStore']);
			$router->resource('trader-categories', 'TraderCategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/traders/batch', ['uses' => 'TraderController@batchStore']);
			$router->resource('traders', 'TraderController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/units/batch', ['uses' => 'UnitController@batchStore']);
			$router->resource('units', 'UnitController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

			$router->post('/whs/batch', ['uses' => 'WhController@batchStore']);
			$router->resource('whs', 'WhController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

		});
	}
}
