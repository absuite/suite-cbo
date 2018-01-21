<?php

namespace Suite\Cbo\Models;
use Closure;
use GAuth;
use Gmf\Sys\Builder;
use Gmf\Sys\Libs\InputHelper;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Province extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_provinces';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'short_name', 'area_id', 'country_id', 'is_effective'];
	protected $casts = [
		'is_effective' => 'integer',
	];
	public function country() {
		return $this->belongsTo('Suite\Cbo\Models\Country');
	}
	public function area() {
		return $this->belongsTo('Suite\Cbo\Models\Area');
	}

	public static function fromImport($datas) {
		return $datas->map(function ($row) {
			$entId = GAuth::entId();

			$data = array_only($row, ['code', 'name', 'short_name']);
			$data = InputHelper::fillEntity($data, $row, [
				'country' => function ($v, $data) use ($entId) {
					return Country::where('code', $v)->value('id');
				},
				'area' => function ($v, $data) use ($entId) {
					return Area::where('ent_id', $entId)->where(function ($query) use ($v) {$query->where('code', $v)->orWhere('name', $v);})->value('id');
				},
			]);

			Validator::make($data, [
				'code' => 'required',
				'name' => 'required',
			])->validate();
			return static::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		});
	}

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'short_name', 'area_id', 'country_id', 'is_effective']);

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
			if (!empty($builder->country)) {
				$tmpItem = Country::where(function ($query) use ($builder) {
					$query->where('code', $builder->country)->orWhere('name', $builder->country);
				})->first();
			}
			if ($tmpItem) {
				$data['country_id'] = $tmpItem->id;
			}
			$find = array_only($data, ['code', 'ent_id']);
			static::updateOrCreate($find, $data);
		});
	}
}
