<?php
namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Models\Entity;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_cbo_units';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'type_enum', 'code', 'name'
		, 'round_precision', 'round_value', 'round_type_enum'];

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'type_enum', 'code', 'name', 'round_precision', 'round_value', 'round_type_enum']);
			if (empty($data['round_precision'])) {
				$data['round_precision'] = 2;
			}
			$tmpItem = false;
			if (empty($builder->type_enum) && !empty($builder->type_name)) {
				$tmpItem = Entity::getEnumItem('suite.cbo.unit.type.enum', $builder->type_name);
			}
			if ($tmpItem) {
				$data['type_enum'] = $tmpItem->name;
			}

			$find = array_only($data, ['code', 'ent_id']);
			static::updateOrCreate($find, $data);
		});
	}
}
