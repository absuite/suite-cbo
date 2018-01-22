<?php
$ns = 'Suite\Cbo\Http\Controllers';
Route::prefix('api/cbo')->middleware(['api', 'auth:api'])->namespace($ns)->group(function () {
	Route::post('/orgs/batch', 'OrgController@batchStore');
	Route::resource('orgs', 'OrgController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/depts/batch', 'DeptController@batchStore');
	Route::resource('depts', 'DeptController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/works/batch', 'WorkController@batchStore');
	Route::resource('works', 'WorkController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/teams/batch', 'TeamController@batchStore');
	Route::resource('teams', 'TeamController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/areas/batch', 'AreaController@batchStore');
	Route::resource('areas', 'AreaController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/provinces/batch', 'ProvinceController@batchStore');
	Route::resource('provinces', 'ProvinceController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/countries/batch', 'CountryController@batchStore');
	Route::resource('countries', 'CountryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/currencies/batch', 'CurrencyController@batchStore');
	Route::resource('currencies', 'CurrencyController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/teams/batch', 'DivisionController@batchStore');
	Route::resource('divisions', 'DivisionController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/item-categories/batch', 'ItemCategoryController@batchStore');
	Route::resource('item-categories', 'ItemCategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/items/batch', 'ItemController@batchStore');
	Route::resource('items', 'ItemController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/lots/batch', 'LotController@batchStore');
	Route::resource('lots', 'LotController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/teams/batch', 'MfcCategoryController@batchStore');
	Route::resource('mfc-categories', 'MfcCategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/mfcs/batch', 'MfcController@batchStore');
	Route::resource('mfcs', 'MfcController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('period-calendars/{id}/build', 'PeriodCalendarController@build');
	Route::post('/period-calendars/batch', 'PeriodCalendarController@batchStore');
	Route::get('/period-calendars/{id}/lines', 'PeriodCalendarController@showLines');
	Route::resource('period-calendars', 'PeriodCalendarController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/period-accounts/batch', 'PeriodAccountController@batchStore');
	Route::resource('period-accounts', 'PeriodAccountController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/doc-types/batch', 'DocTypeController@batchStore');
	Route::resource('doc-types', 'DocTypeController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/persons/batch', 'PersonController@batchStore');
	Route::resource('persons', 'PersonController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/project-categories/batch', 'ProjectCategoryController@batchStore');
	Route::resource('project-categories', 'ProjectCategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/projects/batch', 'ProjectController@batchStore');
	Route::resource('projects', 'ProjectController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/trader-categories/batch', 'TraderCategoryController@batchStore');
	Route::resource('trader-categories', 'TraderCategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/traders/batch', 'TraderController@batchStore');
	Route::resource('traders', 'TraderController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/units/batch', 'UnitController@batchStore');
	Route::resource('units', 'UnitController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

	Route::post('/whs/batch', 'WhController@batchStore');
	Route::resource('whs', 'WhController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

});