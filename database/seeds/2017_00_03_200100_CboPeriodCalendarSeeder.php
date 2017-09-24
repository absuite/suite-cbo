<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboPeriodCalendarSeeder extends Seeder {
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

		Models\PeriodCalendar::where('ent_id', $this->entId)->delete();

		Models\PeriodCalendar::build(function (Builder $b) {$b->ent_id($this->entId)->code("month")->name("默认月度日历")->type_enum("months")->from_date("2017.01.01");});

	}
}
