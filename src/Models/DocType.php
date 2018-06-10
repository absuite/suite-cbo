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
use Gmf\Sys\Models\Entity;
use Gmf\Sys\Database\Concerns\BatchImport;
class DocType extends Model {
	use Snapshotable, HasGuard,BatchImport;
	protected $table = 'suite_cbo_doc_types';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'biz_type_enum', 'code', 'name'];
	//属性
	public function setEntIdAttribute($value) {
		$this->attributes['ent_id'] = empty($value) ? null : $value;
	}

	public function formatDefaultValue($attrs) {
		if (empty($this->ent_id)) {
			$this->ent_id = GAuth::entId();
		}
		if (empty($this->biz_type_enum) && !empty($attrs['biz_type']) && $v = $attrs['biz_type']) {
			$v = (!empty($v['code'])) ? $v['code'] : ((!empty($v->code)) ? $v = $v->code : (is_string($v) ? $v : false));
			$this->biz_type_enum = Entity::getEnumValue('suite.cbo.biz.type.enum', $v);
		}
	}
	public function validate() {
		Validator::make($this->toArray(), [
			'ent_id' => ['required'],
			'code' => ['required'],
			'name' => ['required'],
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
