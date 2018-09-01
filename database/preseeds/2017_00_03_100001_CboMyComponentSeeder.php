<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CboMyComponentSeeder extends Seeder {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {
		$exception = DB::transaction(function () {
			Models\Component::build(function (Builder $builder) {
				$builder->code('myProfileInfo')->type_enum('ui')->name('个人资料');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('myProfileUser')->type_enum('ui')->name('资料修改');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('myProfilePasswrod')->type_enum('ui')->name('密码修改');
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Models\Component::where('code', 'like', 'my.%')->delete();
	}
}
