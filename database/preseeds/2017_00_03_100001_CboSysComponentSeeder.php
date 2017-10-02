<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CboSysComponentSeeder extends Seeder {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {
		$this->down();
		$exception = DB::transaction(function () {
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.language.list')->name('语言列表')->path('sysLanguageList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.language.edit')->name('语言')->path('sysLanguageEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.profile.list')->name('参数列表')->path('sysProfileList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.profile.edit')->name('参数')->path('sysProfileEdit');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.category.edit')->name('接口类型')->path('sysDtiCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.category.list')->name('接口类型列表')->path('sysDtiCategoryList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.param.edit')->name('接口参数')->path('sysDtiParamEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.param.list')->name('接口参数列表')->path('sysDtiParamList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.log.list')->name('接口日志')->path('sysDtiLogList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.item.edit')->name('接口')->path('sysDtiItemEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.item.list')->name('接口列表')->path('sysDtiItemList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('dashboard')->name('首页')->path('dashboard');
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Models\Component::where('code', 'dashboard')->delete();
		Models\Component::where('code', 'like', 'sys.%')->delete();
	}
}
