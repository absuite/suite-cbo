<?php

namespace Suite\Cbo\Models;
use Closure;
use GAuth;
use Gmf\Sys\Builder;
use Gmf\Sys\Database\Concerns\BatchImport;
use Gmf\Sys\Models\Entity;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Log;

class Item extends Model {
	use Snapshotable, HasGuard, BatchImport;
	protected $table = 'suite_cbo_items';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'category_id', 'code', 'name', 'memo', 'form_enum',
		'currency_id', 'price', 'unit_id', 'trader_id'];

	//属性
	public function setEntIdAttribute($value) {

		$this->attributes['ent_id'] = empty($value) ? null : $value;
	}
	public function setCategoryIdAttribute($value) {
		$this->attributes['category_id'] = empty($value) ? null : $value;
	}
	public function setCurrencyIdAttribute($value) {
		$this->attributes['currency_id'] = empty($value) ? null : $value;
	}
	public function setUnitIdAttribute($value) {
		$this->attributes['unit_id'] = empty($value) ? null : $value;
	}
	public function setTraderIdAttribute($value) {
		$this->attributes['trader_id'] = empty($value) ? null : $value;
	}

	public function category() {
		return $this->belongsTo('Suite\Cbo\Models\ItemCategory');
	}
	public function unit() {
		return $this->belongsTo('Suite\Cbo\Models\Unit');
	}
	public function formatDefaultValue($attrs) {
		if (empty($this->price)) {
			$this->price = 0;
		}
		if (empty($this->ent_id)) {
			$this->ent_id = GAuth::entId();
		}
		if (empty($this->currency_id) && !empty($attrs['currency']) && $v = $attrs['currency']) {
			$v = (!empty($v['code'])) ? $v['code'] : ((!empty($v->code)) ? $v = $v->code : (is_string($v) ? $v : false));		
			$this->currency_id = Currency::where('code', $v)->where('ent_id', $this->ent_id)->value('id');
		}
		if (empty($this->category_id) && !empty($attrs['category']) && $v = $attrs['category']) {
			$v = (!empty($v['code'])) ? $v['code'] : ((!empty($v->code)) ? $v = $v->code : (is_string($v) ? $v : false));
			$this->category_id = ItemCategory::where('code', $v)->where('ent_id', $this->ent_id)->value('id');
		}
		if (empty($this->unit_id) && !empty($attrs['unit']) && $v = $attrs['unit']) {
			$v = (!empty($v['code'])) ? $v['code'] : ((!empty($v->code)) ? $v = $v->code : (is_string($v) ? $v : false));
			$this->unit_id = Unit::where('code', $v)->where('ent_id', $this->ent_id)->value('id');
		}
		if (empty($this->trader_id) && !empty($attrs['trader']) && $v = $attrs['trader']) {
			$v = (!empty($v['code'])) ? $v['code'] : ((!empty($v->code)) ? $v = $v->code : (is_string($v) ? $v : false));
			$this->trader_id = Trader::where('code', $v)->where('ent_id', $this->ent_id)->value('id');
		}
		if (empty($this->form_enum) && !empty($attrs['form']) && $v = $attrs['form']) {
			$v = (!empty($v['code'])) ? $v['code'] : ((!empty($v->code)) ? $v = $v->code : (is_string($v) ? $v : false));
			$this->form_enum = Entity::getEnumValue('suite.cbo.item.form.enum', $v);
		}
	}
	public function validate() {
		Validator::make($this->toArray(), [
			'ent_id' => ['required'],
			'code' => ['required'],
			'name' => ['required'],
			'price' => ['numeric'],
		])->validate();
	}
	public function uniqueQuery($query) {
		$query->where([
			'ent_id' => $this->ent_id,
			'code' => $this->code,
		]);
	}
	public static function fromImport($datas) {
		$datas = $datas->map(function ($row) {
			$row['data_src_identity'] = 'import';
			$row['ent_id'] = GAuth::entId();
			return $row;
		});
		static::BatchImport($datas);
	}

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);
			static::BatchImport([$builder]);
		});
	}
}
