<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

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

			static::create($data);
		});
	}
}
