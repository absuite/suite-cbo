<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboCurrencySeeder extends Seeder {
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
		if (Models\Currency::where('ent_id', $this->entId)->count()) {
			return;
		}
		Models\Currency::build(function (Builder $b) {$b->ent_id($this->entId)->code("CNY")->name("人民币")->symbol("￥");});
		Models\Currency::build(function (Builder $b) {$b->ent_id($this->entId)->code("EUR")->name("欧元")->symbol("€");});
		Models\Currency::build(function (Builder $b) {$b->ent_id($this->entId)->code("GBP")->name("英镑")->symbol("£");});
		Models\Currency::build(function (Builder $b) {$b->ent_id($this->entId)->code("HKD")->name("香港元")->symbol("$");});
		Models\Currency::build(function (Builder $b) {$b->ent_id($this->entId)->code("JPY")->name("日圆")->symbol("￥");});
		Models\Currency::build(function (Builder $b) {$b->ent_id($this->entId)->code("TWD")->name("新台币元")->symbol("NT$");});
		Models\Currency::build(function (Builder $b) {$b->ent_id($this->entId)->code("USD")->name("美元")->symbol("$");});

	}
}
