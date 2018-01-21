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

class Org extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_orgs';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'short_name', 'avatar', 'manager_id', 'is_effective'];
	protected $casts = [
		'is_effective' => 'integer',
	];
	public function ent() {
		return $this->belongsTo('Gmf\Sys\Models\Ent');
	}
	public function manager() {
		return $this->belongsTo('Suite\Cbo\Models\Person');
	}

	public static function fromImport($datas) {
		return $datas->map(function ($row) {
			$entId = GAuth::entId();

			$data = array_only($row, ['code', 'name', 'short_name', 'avatar']);
			$data = InputHelper::fillEntity($data, $row, [
				'manager' => function ($v, $data) use ($entId) {
					return Person::where('ent_id', $entId)->where(function ($query) use ($v) {$query->where('code', $v)->orWhere('name', $v);})->value('id');
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

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'short_name', 'avatar', 'manager_id', 'is_effective']);

			$tmpItem = false;
			if (!empty($builder->manager)) {
				$tmpItem = Person::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->manager)->orWhere('name', $builder->manager);
				})->first();
			}
			if ($tmpItem) {
				$data['manager_id'] = $tmpItem->id;
			}
			$find = array_only($data, ['code', 'ent_id']);
			static::updateOrCreate($find, $data);
		});
	}
}
