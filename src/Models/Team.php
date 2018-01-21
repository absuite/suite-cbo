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

class Team extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_teams';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'org_id', 'dept_id', 'work_id', 'manager_id', 'is_effective'];
	protected $casts = [
		'is_effective' => 'integer',
	];

	public function ent() {
		return $this->belongsTo('Gmf\Sys\Models\Ent');
	}

	public function org() {
		return $this->belongsTo('Suite\Cbo\Models\Org');
	}

	public function dept() {
		return $this->belongsTo('Suite\Cbo\Models\Dept');
	}

	public function work() {
		return $this->belongsTo('Suite\Cbo\Models\Work');
	}
	public function manager() {
		return $this->belongsTo('Suite\Cbo\Models\Person');
	}

	public static function fromImport($datas) {
		return $datas->map(function ($row) {
			$entId = GAuth::entId();

			$data = array_only($row, ['code', 'name']);
			$data = InputHelper::fillEntity($data, $row, [
				'org' => function ($v, $data) use ($entId) {
					return Org::where('ent_id', $entId)->where(function ($query) use ($v) {$query->where('code', $v)->orWhere('name', $v);})->value('id');
				},
				'dept' => function ($v, $data) use ($entId) {
					return Dept::where('ent_id', $entId)->where(function ($query) use ($v) {$query->where('code', $v)->orWhere('name', $v);})->value('id');
				},
				'work' => function ($v, $data) use ($entId) {
					return Work::where('ent_id', $entId)->where(function ($query) use ($v) {$query->where('code', $v)->orWhere('name', $v);})->value('id');
				},
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

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'org_id', 'dept_id', 'work_id', 'manager_id', 'is_effective']);

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
			if (!empty($builder->dept)) {
				$tmpItem = Dept::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->dept)->orWhere('name', $builder->dept);
				})->first();
			}
			if ($tmpItem) {
				$data['dept_id'] = $tmpItem->id;
			}

			$tmpItem = false;
			if (!empty($builder->work)) {
				$tmpItem = Work::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->work)->orWhere('name', $builder->work);
				})->first();

			}
			if ($tmpItem) {
				$data['work_id'] = $tmpItem->id;
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
			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}
}
