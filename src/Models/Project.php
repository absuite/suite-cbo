<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_projects';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'category_id', 'code', 'name'];
	public function category() {
		return $this->belongsTo('Suite\Cbo\Models\ProjectCategory');
	}

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'category_id', 'code', 'name']);

			$tmpItem = false;
			if (!empty($builder->category)) {
				$tmpItem = ProjectCategory::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->category)->orWhere('name', $builder->category);
				})->first();
			}
			if ($tmpItem) {
				$data['category_id'] = $tmpItem->id;
			}
			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);;
		});
	}
}
