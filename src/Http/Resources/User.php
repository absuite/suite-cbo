<?php

namespace Suite\Cbo\Http\Resources;

use Gmf\Sys\Http\Resources\Resource;

class User extends Resource {
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request
   * @return array
   */
  public function toArray($request) {
    if (empty($this->ent_id)) {
      return false;
    }
    $rtn = [
      'id' => $this->ent_id,
      'type_enum' => $this->type_enum,
      'is_effective' => \boolval($this->is_effective),
      'created_at' => $this->created_at . '',
    ];
    if ($this->user) {
      $rtn['openid'] = $this->user->openid;
      $rtn['name'] = $this->user->name;
      $rtn['avatar'] = $this->user->avatar;
      $rtn['account'] = $this->user->account;
      $rtn['memo'] = $this->user->memo;
      $rtn['type'] = $this->user->type;
    }
    return $rtn;
  }
}
