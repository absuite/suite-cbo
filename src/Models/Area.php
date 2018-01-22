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
	public static function fromImport($datas) {
		return $datas->map(function ($row) {
			return static::fromImportItem($row);
		});
	}
	public static function fromImportItem($row, $id = false) {
		$entId = GAuth::entId();

		$data = array_only($row, ['code', 'name', 'short_name', 'is_effective']);
		$data = InputHelper::fillEntity($data, $row, [
			'country' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Country::where('code', $v)->value('id');
			},
		]);
		Validator::make($data, [
			'code' => 'required',
			'name' => 'required',
		])->validate();
		if ($id) {
			return static::updateOrCreate(['ent_id' => $entId, 'id' => $id], $data);
		} else {
			return static::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}

	}
	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'country_id', 'code', 'name', 'short_name', 'is_effective']);

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
