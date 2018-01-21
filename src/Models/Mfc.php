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
	public function category() {
		return $this->belongsTo('Suite\Cbo\Models\MfcCategory');
	}

	public static function fromImport($datas) {
		return $datas->map(function ($row) {
			$entId = GAuth::entId();
			$data = array_only($row, ['code', 'name']);
			Validator::make($data, [
				'code' => 'required',
				'name' => 'required',
			])->validate();

			$data = InputHelper::fillEntity($data, $row, [
				'category' => function ($v, $data) use ($entId) {
					return MfcCategory::where('ent_id', $entId)->where(function ($query) use ($v) {
						$query->where('code', $v)->orWhere('name', $v);
					})->value('id');
				},
			]);
			return static::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		});
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
