<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models\Authority\Permit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SysPermitSeeder extends Seeder {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {

		$exception = DB::transaction(function () {
			Permit::build(function (Builder $builder) {
				$builder->code('suite.permit.menu.edit')->name('菜单编辑');
			});
			Permit::build(function (Builder $builder) {
				$builder->code('suite.permit.menu.add')->name('菜单新增');
			});

			Permit::build(function (Builder $builder) {
				$builder->code('suite.permit.query.edit')->name('查询方案编辑');
			});
			Permit::build(function (Builder $builder) {
				$builder->code('suite.permit.report.edit')->name('报表编辑');
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Permit::where('code', 'like', 'suite.permit.%')->delete();
	}
}
