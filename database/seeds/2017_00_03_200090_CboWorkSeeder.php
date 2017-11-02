<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboWorkSeeder extends Seeder {
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
		if (Models\Work::where('ent_id', $this->entId)->count()) {
			return;
		}
		Models\Work::build(function (Builder $b) {$b->ent_id($this->entId)->code("wc8100501")->name("车工中心")->org("org810")->dept("dp81005");});
		Models\Work::build(function (Builder $b) {$b->ent_id($this->entId)->code("wc8100502")->name("铣工中心")->org("org810")->dept("dp81005");});

	}
}
