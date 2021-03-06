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

class Mfc extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_mfcs';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'category_id', 'code', 'name'];

	//属性
	public function setEntIdAttribute($value) {
		$this->attributes['ent_id'] = empty($value) ? null : $value;
	}
	public function setCategoryIdAttribute($value) {
		$this->attributes['category_id'] = empty($value) ? null : $value;
	}

	public function category() {
		return $this->belongsTo('Suite\Cbo\Models\MfcCategory');
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

		$data = InputHelper::fillEntity($data, $row, [
			'category' => function ($v, $data) use ($entId) {
				if (!empty($v) && is_array($v) && !empty($v['code'])) {$v = $v['code'];} else if (!empty($v) && is_object($v) && !empty($v->code)) {$v = $v->code;}
				if (empty($v)) {
					return false;
				}
				return MfcCategory::where('ent_id', $entId)->where(function ($query) use ($v) {$query->where('code', $v)->orWhere('name', $v);})->value('id');
			},
		]);
		if ($id) {
			return static::updateOrCreate(['ent_id' => $entId, 'id' => $id], $data);
		} else {
			return static::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
	}
	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'category_id', 'code', 'name']);

			$tmpItem = false;
			if (!empty($builder->category)) {
				$tmpItem = MfcCategory::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->category)->orWhere('name', $builder->category);
				})->first();
			}
			if ($tmpItem) {
				$data['category_id'] = $tmpItem->id;
			}
			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}
}
