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

class TraderCategory extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_trader_categories';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'name', 'type_enum'];

	public static function fromImport($datas) {
		return $datas->map(function ($row, $key) {
			return static::fromImportItem($row);
		});
	}
	public static function fromImportItem($row, $id = false) {
		$entId = GAuth::entId();
		$data = array_only($row, ['code', 'name', 'type_enum']);
		$data = InputHelper::fillEnum($data, $row, [
			'type' => 'suite.cbo.trader.type.enum',
		]);
		$validator = Validator::make($data, [
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

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'name', 'type_enum']);

			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}
}
