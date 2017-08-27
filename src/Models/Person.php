<?php
namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Person extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_persons';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'dept_id', 'code', 'name'];
	public function dept() {
		return $this->belongsTo('Suite\Cbo\Models\Dept');
	}

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'dept_id', 'code', 'name']);

			$tmpItem = false;
			if (!empty($builder->dept)) {
				$tmpItem = Dept::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->dept)->orWhere('name', $builder->dept);
				})->first();
			}
			if ($tmpItem) {
				$data['dept_id'] = $tmpItem->id;
			}
			static::create($data);
		});
	}
}
