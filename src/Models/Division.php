<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Division extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_divisions';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'short_name', 'area_id', 'province_id', 'country_id', 'is_effective'];
	protected $casts = [
		'is_effective' => 'integer',
	];
	public function country() {
		return $this->belongsTo('Suite\Cbo\Models\Country');
	}
	public function area() {
		return $this->belongsTo('Suite\Cbo\Models\Area');
	}
	public function province() {
		return $this->belongsTo('Suite\Cbo\Models\Province');
	}

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'short_name', 'area_id', 'province_id', 'country_id', 'is_effective']);

			$tmpItem = false;
			if (!empty($builder->area)) {
				$tmpItem = Area::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->area)->orWhere('name', $builder->area);
				})->first();
			}
			if ($tmpItem) {
				$data['area_id'] = $tmpItem->id;
			}

			$tmpItem = false;
			if (!empty($builder->province)) {
				$tmpItem = Province::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->province)->orWhere('name', $builder->province);
				})->first();
			}
			if ($tmpItem) {
				$data['province_id'] = $tmpItem->id;
			}

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
