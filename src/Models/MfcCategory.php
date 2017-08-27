<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class MfcCategory extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_mfc_categories';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name'];

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name']);

			static::create($data);
		});
	}
}
