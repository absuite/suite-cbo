<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboPeriodAccountSeeder extends Seeder {
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

		Models\PeriodAccount::where('ent_id', $this->entId)->delete();

		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201701")->name("201701")->from_date("2017.01.01")->to_date("2017.01.31")->year("2017")->month("1")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201702")->name("201702")->from_date("2017.02.01")->to_date("2017.02.28")->year("2017")->month("2")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201703")->name("201703")->from_date("2017.03.01")->to_date("2017.03.31")->year("2017")->month("3")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201704")->name("201704")->from_date("2017.04.01")->to_date("2017.04.30")->year("2017")->month("4")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201705")->name("201705")->from_date("2017.05.01")->to_date("2017.05.31")->year("2017")->month("5")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201706")->name("201706")->from_date("2017.06.01")->to_date("2017.06.30")->year("2017")->month("6")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201707")->name("201707")->from_date("2017.07.01")->to_date("2017.07.31")->year("2017")->month("7")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201708")->name("201708")->from_date("2017.08.01")->to_date("2017.08.31")->year("2017")->month("8")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201709")->name("201709")->from_date("2017.09.01")->to_date("2017.09.30")->year("2017")->month("9")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201710")->name("201710")->from_date("2017.10.01")->to_date("2017.10.31")->year("2017")->month("10")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201711")->name("201711")->from_date("2017.11.01")->to_date("2017.11.30")->year("2017")->month("11")->calendar("month");});
		Models\PeriodAccount::build(function (Builder $b) {$b->ent_id($this->entId)->code("201712")->name("201712")->from_date("2017.12.01")->to_date("2017.12.31")->year("2017")->month("12")->calendar("month");});

	}
}
