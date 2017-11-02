<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_traders';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'category_id', 'code', 'name'
		, 'country_id', 'province_id', 'division_id', 'area_id', 'type_enum', 'is_effective'];
	protected $casts = [
		'is_effective' => 'integer',
	];
	public function category() {
		return $this->belongsTo('Suite\Cbo\Models\TraderCategory');
	}

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'category_id', 'code', 'name', 'country_id', 'province_id', 'division_id', 'area_id', 'is_supplier', 'is_customer', 'is_effective']);

			$tmpItem = false;
			if (!empty($builder->category)) {
				$tmpItem = TraderCategory::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->category)->orWhere('name', $builder->category);
				})->first();
			}
			if ($tmpItem) {
				$data['category_id'] = $tmpItem->id;
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
			if (!empty($builder->division)) {
				$tmpItem = Division::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->division)->orWhere('name', $builder->division);
				})->first();
			}
			if ($tmpItem) {
				$data['division_id'] = $tmpItem->id;
			}

			$tmpItem = false;
			if (!empty($builder->area)) {
				$tmpItem = Area::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->area)->orWhere('name', $builder->area);
				})->first();
			}
			if ($tmpItem) {
				$data['area_id'] = $tmpItem->id;
			}

			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}
}
