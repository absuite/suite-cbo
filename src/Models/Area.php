<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Area extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_areas';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'country_id', 'code', 'name', 'short_name', 'is_effective'];
	protected $casts = [
		'is_effective' => 'integer',
	];
	public function country() {
		return $this->belongsTo('Suite\Cbo\Models\Country');
	}
	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'country_id', 'code', 'name', 'short_name', 'is_effective']);

			$tmpItem = false;
			if (!empty($builder->country)) {
				$tmpItem = Country::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->country)->orWhere('name', $builder->country);
				})->first();
			}
			if ($tmpItem) {
				$data['country_id'] = $tmpItem->id;
			}

			static::create($data);
		});
	}
}
