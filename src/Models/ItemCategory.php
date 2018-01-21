<?php

namespace Suite\Cbo\Models;
use Closure;
use GAuth;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class ItemCategory extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_item_categories';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name'];

	public static function fromImport($datas) {
		return $datas->map(function ($data) {
			$entId = GAuth::entId();
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

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name']);

			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}
}
