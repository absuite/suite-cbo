<?php

namespace Suite\Cbo\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Models\Entity;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

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

	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'category_id', 'code', 'name', 'memo', 'form_enum', 'currency_id', 'price', 'unit_id', 'trader_id']);

			$tmpItem = false;
			if (!empty($builder->category)) {
				$tmpItem = ItemCategory::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->category)->orWhere('name', $builder->category);
				})->first();
			}
			if ($tmpItem) {
				$data['category_id'] = $tmpItem->id;
			}

			$tmpItem = false;
			if (!empty($builder->currency)) {
				$tmpItem = Currency::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->currency)->orWhere('name', $builder->currency);
				})->first();
			}
			if ($tmpItem) {
				$data['currency_id'] = $tmpItem->id;
			}

			$tmpItem = false;
			if (!empty($builder->unit)) {
				$tmpItem = Unit::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->unit)->orWhere('name', $builder->unit);
				})->first();
			}
			if ($tmpItem) {
				$data['unit_id'] = $tmpItem->id;
			}

			$tmpItem = false;
			if (!empty($builder->trader)) {
				$tmpItem = Trader::where('ent_id', $builder->ent_id)->where(function ($query) use ($builder) {
					$query->where('code', $builder->trader)->orWhere('name', $builder->trader);
				})->first();
			}
			if ($tmpItem) {
				$data['trader_id'] = $tmpItem->id;
			}

			$tmpItem = false;
			if (empty($builder->form_enum) && !empty($builder->form_name)) {
				$tmpItem = Entity::getEnumItem('suite.cbo.item.form.enum', $builder->form_name);
			}
			if ($tmpItem) {
				$data['form_enum'] = $tmpItem->name;
			}
			$find = array_only($data, ['ent_id', 'code']);
			static::updateOrCreate($find, $data);
		});
	}
}
