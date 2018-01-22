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

class Item extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_items';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'category_id', 'code', 'name', 'memo', 'form_enum', 'currency_id', 'price', 'unit_id', 'trader_id'];
	public function category() {
		return $this->belongsTo('Suite\Cbo\Models\ItemCategory');
	}
	public function unit() {
		return $this->belongsTo('Suite\Cbo\Models\Unit');
	}
	public static function fromImportItem($row, $id = false) {
		if (!empty($row['ent_id'])) {
			$entId = $row['ent_id'];
		} else {
			$entId = GAuth::entId();
		}
		$data = array_only($row, [
			'code', 'name', 'memo', 'form_enum', 'price',
		]);
		Validator::make($data, [
			'code' => 'required',
			'name' => 'required',
		])->validate();
		$data = InputHelper::fillEntity($data, $row, [
			'currency' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Currency::where('code', $v)->where('ent_id', $entId)->value('id');
			},
			'category' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return ItemCategory::where('code', $v)->where('ent_id', $entId)->value('id');
			},
			'unit' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Unit::where('code', $v)->where('ent_id', $entId)->value('id');
			},
			'trader' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return Trader::where('code', $v)->where('ent_id', $entId)->value('id');
			},
		]);
		$data = InputHelper::fillEnum($data, $row, [
			'form' => 'suite.cbo.item.form.enum',
		]);
		if (empty($data['price'])) {
			$data['price'] = 0;
		}
		if ($id) {
			return static::updateOrCreate(['ent_id' => $entId, 'id' => $id], $data);
		} else {
			return static::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
	}
	public static function fromImport($datas) {
		return $datas->map(function ($row, $key) {
			return static::fromImportItem($row);
		});
	}

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);
			$data = array_only($builder->toArray(), ['id', 'ent_id', 'category_id', 'code', 'name', 'memo', 'form_enum', 'currency_id', 'price', 'unit_id', 'trader_id']);
			static::fromImport(collect($data));
		});
	}
}
