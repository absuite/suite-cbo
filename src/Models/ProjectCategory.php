<?php

namespace Suite\Cbo\Models;
use Closure;
use GAuth;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ProjectCategory extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_project_categories';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name'];

	//属性
	public function setEntIdAttribute($value) {
		$this->attributes['ent_id'] = empty($value) ? null : $value;
	}

	public static function fromImport($datas) {
		return $datas->map(function ($row) {
			return static::fromImportItem($row);
		});
	}
	public static function fromImportItem($row, $id = false) {
		$entId = GAuth::entId();
		$data = array_only($row, ['code', 'name']);
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

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name']);

			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}

}
