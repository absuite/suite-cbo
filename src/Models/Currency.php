<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_currencies';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'symbol'
		, 'money_round_precision', 'money_round_value', 'money_round_type_enum'
		, 'price_round_precision', 'price_round_value', 'price_round_type_enum'];

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'symbol']);

			if (empty($data['money_round_precision'])) {
				$data['money_round_precision'] = 2;
			}

			if (empty($data['price_round_precision'])) {
				$data['price_round_precision'] = 2;
			}
			$find = array_only($data, ['code', 'ent_id']);
			static::updateOrCreate($find, $data);
		});
	}
}
