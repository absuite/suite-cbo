<?php

namespace Suite\Cbo\Models;
use Closure;
use GAuth;
use Gmf\Sys\Builder;
use Gmf\Sys\Libs\InputHelper;
use Gmf\Sys\Models\Entity;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Dept extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_depts';
	public $incrementing = false;
	protected $keyType = 'string';
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'org_id', 'type_enum', 'manager_id', 'is_effective'];
	protected $casts = [
		'is_effective' => 'integer',
	];

	//属性
	public function setEntIdAttribute($value) {
		$this->attributes['ent_id'] = empty($value) ? null : $value;
	}
	public function setOrgIdAttribute($value) {
		$this->attributes['org_id'] = empty($value) ? null : $value;
	}
	public function setManagerIdAttribute($value) {
		$this->attributes['manager_id'] = empty($value) ? null : $value;
	}

	public function ent() {
		return $this->belongsTo('Gmf\Sys\Models\Ent');
	}
	public function org() {
		return $this->belongsTo('Suite\Cbo\Models\Org');
	}
	public function manager() {
		return $this->belongsTo('Suite\Cbo\Models\Person');
	}

	public static function fromImport($datas) {
		return $datas->map(function ($row) {
			return static::fromImportItem($row);
		});
	}
	public static function fromImportItem($row, $id = false) {
		$entId = GAuth::entId();

		$data = array_only($row, ['code', 'name']);
		$data = InputHelper::fillEntity($data, $row, [
			'org' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Org::where('ent_id', $entId)->where(function ($query) use ($v) {$query->where('code', $v)->orWhere('name', $v);})->value('id');
			},
			'manager' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Person::where('ent_id', $entId)->where(function ($query) use ($v) {$query->where('code', $v)->orWhere('name', $v);})->value('id');
			},
		]);
		$data = InputHelper::fillEnum($data, $row, [
			'type' => 'suite.cbo.dept.type.enum',
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

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'org_id', 'type_enum', 'manager_id', 'is_effective']);
			$tmpItem = false;
			if (!empty($builder->org)) {
				$tmpItem = Org::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->org)->orWhere('name', $builder->org);
				})->first();
			}
			if ($tmpItem) {
				$data['org_id'] = $tmpItem->id;
			}
			$tmpItem = false;
			if (!empty($builder->manager)) {
				$tmpItem = Person::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->manager)->orWhere('name', $builder->manager);
				})->first();
			}
			if ($tmpItem) {
				$data['manager_id'] = $tmpItem->id;
			}
			$tmpItem = false;
			if (empty($builder->type_enum) && !empty($builder->type_name)) {
				$tmpItem = Entity::getEnumItem('suite.cbo.dept.type.enum', $builder->type_name);
			}
			if ($tmpItem) {
				$data['type_enum'] = $tmpItem->name;
			}

			$find = array_only($data, ['code', 'ent_id']);
			static::updateOrCreate($find, $data);
		});
	}
}
