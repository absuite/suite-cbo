<?php

namespace Suite\Cbo\Models;
use Closure;
use Exception;
use Gmf\Sys\Builder;
use Gmf\Sys\Models\Entity;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class PeriodCalendar extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_period_calendars';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'type_enum', 'from_date', 'to_date'];

	//属性
	public function setEntIdAttribute($value) {
		$this->attributes['ent_id'] = empty($value) ? null : $value;
	}

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'type_enum', 'from_date', 'to_date']);

			$tmpItem = false;
			if (empty($builder->type_enum) && !empty($builder->type_name)) {
				$tmpItem = Entity::getEnumItem('suite.cbo.period.type.enum', $builder->type_name);
			}
			if ($tmpItem) {
				$data['type_enum'] = $tmpItem->name;
			}

			$find = array_only($data, ['code', 'ent_id']);
			static::updateOrCreate($find, $data);
		});
	}

	public static function buildPeriods($id, $len = 0) {

		$calendar = PeriodCalendar::find($id);
		if (!$calendar) {
			throw new Exception("找不到日历:" . $id, 1);
		}
		if ($calendar) {
			$initTime = strtotime($calendar->from_date);
		}
		$type = $calendar->type_enum; //years,quarters,months,weeks,days
		$unit = intval($calendar->unit);
		if (!$unit) {
			$unit = 1;
		}

		$relativeExp = '+' . $unit . ' day -1 day';
		switch ($type) {
		case 'years':
			$relativeExp = '+1 year -1 day';
			$len = 1;
			break;
		case 'quarters':
			$relativeExp = '+' . ($unit * 3) . ' month -1 day';
			$len = 4;
			break;
		case 'months':
			$relativeExp = '+' . $unit . ' month -1 day';
			$len = 12;
			break;
		case 'weeks':
			$relativeExp = '+' . $unit . ' week -1 day';
			$len = 56;
			break;
		case 'days':
			$relativeExp = '+' . $unit . ' day -1 day';
			$len = 365;
			break;
		}
		$lastPeriod = PeriodAccount::where('calendar_id', $calendar->id)->orderBy('from_date', 'desc')->first();
		if ($lastPeriod) {
			$initTime = strtotime('+1 day', strtotime($lastPeriod->to_date));
		}
		$fromTime = $initTime;
		for ($i = 1; $i <= $len; $i++) {
			$toTime = strtotime($relativeExp, $fromTime);

			$b = new Builder;
			$b->calendar_id($calendar->id)->ent_id($calendar->ent_id)
				->from_date(date('Y-m-d', $fromTime))->to_date(date('Y-m-d', $toTime))
				->year(date('Y', $fromTime))
				->month(date('m', $fromTime))
				->week(date('W', $fromTime));
			$b->code(static::getPeriodCode($type, $unit, $fromTime));
			$b->name(static::getPeriodCode($type, $unit, $fromTime));
			PeriodAccount::create($b->toArray());

			$fromTime = strtotime('+1 days', $toTime);
		}
		return date('Y-m-d', $fromTime);
	}
	private static function getPeriodCode($type, $unit = 1, $date) {
		$rtn = '';
		switch ($type) {
		case 'years':
			$rtn = date('Y', $date);
			break;
		case 'quarters':
			$rtn = date('Ym', $date);
			break;
		case 'months':
			$rtn = date('Ym', $date);
			break;
		case 'weeks':
			$rtn = date('YW', $date);
			break;
		case 'days':
			$rtn = date('Yz', $date);
			break;
		}
		return $rtn;
	}
}
