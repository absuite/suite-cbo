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

class Trader extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_traders';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'category_id', 'code', 'name', 'short_name'
		, 'country_id', 'province_id', 'division_id', 'area_id', 'type_enum', 'is_effective', 'memo'];
	protected $casts = [
		'is_effective' => 'integer',
	];
	public function category() {
		return $this->belongsTo('Suite\Cbo\Models\TraderCategory');
	}
	public function country() {
		return $this->belongsTo('Suite\Cbo\Models\Country');
	}
	public function province() {
		return $this->belongsTo('Suite\Cbo\Models\Province');
	}
	public function division() {
		return $this->belongsTo('Suite\Cbo\Models\Division');
	}
	public function area() {
		return $this->belongsTo('Suite\Cbo\Models\Area');
	}

	public static function fromImport($datas) {
		return $datas->map(function ($row, $key) {
			return static::fromImportItem($row);
		});
	}
	public static function fromImportItem($row, $id = false) {
		if (!empty($row['ent_id'])) {
			$entId = $row['ent_id'];
		} else {
			$entId = GAuth::entId();
		}
		$data = array_only($row, [
			'code', 'name', 'memo', 'short_name', 'is_customer', 'is_supplier',
		]);
		Validator::make($data, [
			'code' => 'required',
			'name' => 'required',
		])->validate();
		$data = InputHelper::fillEntity($data, $row, [
			'country' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Country::where('code', $v)->value('id');
			},
			'category' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return TraderCategory::where('code', $v)->where('ent_id', $entId)->value('id');
			},
			'province' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Province::where('code', $v)->where('ent_id', $entId)->value('id');
			},
			'division' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Division::where('code', $v)->where('ent_id', $entId)->value('id');
			},
			'area' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Area::where('code', $v)->where('ent_id', $entId)->value('id');
			},
		]);
		if ($id) {
			return static::updateOrCreate(['ent_id' => $entId, 'id' => $id], $data);
		} else {
			return static::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
	}
	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'category_id', 'code', 'name', 'short_name', 'country_id', 'province_id', 'division_id', 'area_id', 'is_supplier', 'is_customer', 'is_effective']);

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

			$find = array_only($data, ['area_id', 'ent_id', 'code', 'name']);
			static::updateOrCreate($find, $data);
		});
	}
}
