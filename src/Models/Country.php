<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Country extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_countries';
	public $incrementing = false;
	protected $fillable = ['id', 'code', 'name', 'short_name'];
	public static function fromImport($datas) {
		return $datas->map(function ($row) {

			$data = array_only($row, ['code', 'name', 'short_name']);

			Validator::make($data, [
				'code' => 'required',
				'name' => 'required',
			])->validate();
			return static::updateOrCreate(['code' => $data['code']], $data);
		});
	}
	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);
			$data = array_only($builder->toArray(), ['id', 'code', 'name', 'short_name']);

			$find = array_only($data, ['code']);
			static::updateOrCreate($find, $data);

		});
	}
}
