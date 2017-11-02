<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class TraderCategory extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_trader_categories';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'type_enum'];

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'type_enum']);

			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}
}
