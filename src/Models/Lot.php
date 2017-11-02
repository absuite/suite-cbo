<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_lots';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name'];

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name']);

			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}
}
