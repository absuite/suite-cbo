<?php

use Carbon\Carbon;
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
		if (Models\PeriodCalendar::where('ent_id', $this->entId)->count()) {
			return;
		}
		if (Models\PeriodAccount::where('ent_id', $this->entId)->count()) {
			return;
		}
		$n = Carbon::now();
		$from = Carbon::create($n->year - 1, 1, 1, 0, 0, 0);

		Models\PeriodCalendar::build(function (Builder $b) use ($from) {
			$b->ent_id($this->entId)
				->code("month")
				->name("默认月度日历")
				->type_enum("months")
				->from_date($from->format('Y-m-d'));
		});
		while (true) {
			if ($from->year > $n->year) {
				break;
			}
			$to = $from->addMonth()->subMinutes(2);
			Models\PeriodAccount::build(function (Builder $b) use ($to, $from) {
				$b->ent_id($this->entId)
					->code($to->format('Ym'))
					->name($to->format('Ym'))
					->from_date($from->format('Y-m-d'))
					->to_date($to->format('Y-m-d'))
					->year($to->year)
					->month($to->month)
					->calendar("month");
			});
			$from = Carbon::create($to->year, $to->month, $to->day, 0, 0, 0);
		}
	}
}
