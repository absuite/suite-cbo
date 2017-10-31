<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models\LnsItem;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models\Org;

class CboLnsItemPreSeeder extends Seeder {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {
		LnsItem::build(function (Builder $b) {
			$b->type(Org::class)->code('cbo')->name('组织数');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

	}
}
