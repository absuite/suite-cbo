<?php

namespace Suite\Cbo\Models;
use Closure;
use GAuth;
use Gmf\Sys\Builder;
use Gmf\Sys\Database\Concerns\BatchImport;
use Gmf\Sys\Libs\InputHelper;
use Gmf\Sys\Models\Entity;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Dept extends Model {
  use Snapshotable, HasGuard, BatchImport;
  protected $table = 'suite_cbo_depts';
  public $incrementing = false;
  protected $keyType = 'string';
  protected $fillable = ['id', 'ent_id', 'code', 'name', 'org_id', 'type_enum', 'manager_id', 'is_effective'];
  protected $casts = [
    'is_effective' => 'integer',
  ];

  //属性
  public function setEntIdAttribute($value) {
    $this->attributes['ent_id'] = empty($value) ? null : $value;
  }
  public function setOrgIdAttribute($value) {
    $this->attributes['org_id'] = empty($value) ? null : $value;
  }
  public function setManagerIdAttribute($value) {
    $this->attributes['manager_id'] = empty($value) ? null : $value;
  }

  public function ent() {
    return $this->belongsTo('Gmf\Sys\Models\Ent\Ent');
  }
  public function org() {
    return $this->belongsTo('Suite\Cbo\Models\Org');
  }
  public function manager() {
    return $this->belongsTo('Suite\Cbo\Models\Person');
  }

  public function formatDefaultValue($attrs) {
    if (empty($this->ent_id)) {
      $this->ent_id = GAuth::entId();
    }
    if (empty($this->is_effective)) {
      $this->is_effective = 1;
    }
    if (empty($this->org_id) && !empty($attrs['org']) && $v = $attrs['org']) {
      if ($v = InputHelper::tryGetObjectValue($v, 'code')) {
        $this->org_id = Org::where('code', $v)->where('ent_id', $this->ent_id)->value('id');
      }
    }
    if (empty($this->manager_id) && !empty($attrs['manager']) && $v = $attrs['manager']) {
      if ($v = InputHelper::tryGetObjectValue($v, 'code')) {
        $this->manager_id = Person::where('code', $v)->where('ent_id', $this->ent_id)->value('id');
      }
    }
    if (empty($this->type_enum) && !empty($attrs['type']) && $v = $attrs['type']) {
      if ($v = InputHelper::tryGetObjectValue($v, 'code')) {
        $this->type_enum = Entity::getEnumValue('suite.cbo.dept.type.enum', $v);
      }
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
