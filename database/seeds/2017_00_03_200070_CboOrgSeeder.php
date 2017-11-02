<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboOrgSeeder extends Seeder {
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
		if (Models\Org::where('ent_id', $this->entId)->count()) {
			return;
		}

		Models\Org::build(function (Builder $b) {$b->ent_id($this->entId)->code("org800")->name("800集团公司");});
		Models\Org::build(function (Builder $b) {$b->ent_id($this->entId)->code("org810")->name("810生产公司");});
		Models\Org::build(function (Builder $b) {$b->ent_id($this->entId)->code("org820")->name("820新品公司");});
		Models\Org::build(function (Builder $b) {$b->ent_id($this->entId)->code("org830")->name("830销售公司");});

	}
}
