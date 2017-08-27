<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class PeriodAccount extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_period_accounts';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'calendar_id', 'year', 'month', 'week', 'code', 'name', 'from_date', 'to_date'];

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'calendar_id', 'year', 'month', 'week', 'code', 'name', 'from_date', 'to_date']);

			$tmpItem = false;
			if (!empty($builder->calendar)) {
				$tmpItem = PeriodCalendar::where('code', $builder->calendar)->where('ent_id', $builder->ent_id)->first();
			}
			if ($tmpItem) {
				$data['calendar_id'] = $tmpItem->id;
			}
			static::create($data);
		});
	}

}
