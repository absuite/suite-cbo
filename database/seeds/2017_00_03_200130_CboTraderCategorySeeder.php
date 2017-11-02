<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboTraderCategorySeeder extends Seeder {
	public $entId = '';

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if (empty($this->entId)) {
			$this->entId = config('gmf.ent.id');
		}
		if (empty($this->entId)) {
			return;
		}
		if (Models\TraderCategory::where('ent_id', $this->entId)->count()) {
			return;
		}
		Models\TraderCategory::build(function (Builder $b) {$b->ent_id($this->entId)->code("L01")->name("主供");});
		Models\TraderCategory::build(function (Builder $b) {$b->ent_id($this->entId)->code("L02")->name("辅供");});
		Models\TraderCategory::build(function (Builder $b) {$b->ent_id($this->entId)->code("D01")->name("大客户");});
		Models\TraderCategory::build(function (Builder $b) {$b->ent_id($this->entId)->code("D99")->name("其它客户");});

	}
}
