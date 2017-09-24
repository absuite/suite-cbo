<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboAreaSeeder extends Seeder {
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

		Models\Area::where('ent_id', $this->entId)->delete();

		Models\Area::build(function (Builder $b) {$b->ent_id($this->entId)->code("HZ")->name("华中")->country("CHN");});
		Models\Area::build(function (Builder $b) {$b->ent_id($this->entId)->code("HN")->name("华南")->country("CHN");});
		Models\Area::build(function (Builder $b) {$b->ent_id($this->entId)->code("HB")->name("华北")->country("CHN");});
		Models\Area::build(function (Builder $b) {$b->ent_id($this->entId)->code("HD")->name("华东")->country("CHN");});
		Models\Area::build(function (Builder $b) {$b->ent_id($this->entId)->code("DB")->name("东北")->country("CHN");});
		Models\Area::build(function (Builder $b) {$b->ent_id($this->entId)->code("XB")->name("西北")->country("CHN");});
		Models\Area::build(function (Builder $b) {$b->ent_id($this->entId)->code("XN")->name("西南")->country("CHN");});

	}
}
