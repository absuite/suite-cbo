<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboWhSeeder extends Seeder {
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

		Models\Wh::where('ent_id', $this->entId)->delete();

		Models\Wh::build(function (Builder $b) {$b->ent_id($this->entId)->code("st8000401")->name("集团公司材料仓")->dept("dp80004");});
		Models\Wh::build(function (Builder $b) {$b->ent_id($this->entId)->code("st8100301")->name("生产公司材料仓")->dept("dp81003");});
		Models\Wh::build(function (Builder $b) {$b->ent_id($this->entId)->code("st8100302")->name("生产公司半成品仓")->dept("dp81003");});
		Models\Wh::build(function (Builder $b) {$b->ent_id($this->entId)->code("st8200301")->name("新品公司材料仓")->dept("dp82003");});
		Models\Wh::build(function (Builder $b) {$b->ent_id($this->entId)->code("st8300101")->name("销售公司成品一仓")->dept("dp83001");});
		Models\Wh::build(function (Builder $b) {$b->ent_id($this->entId)->code("st8300102")->name("销售公司成品二仓")->dept("dp83001");});

	}
}
