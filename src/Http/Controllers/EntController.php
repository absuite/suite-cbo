<?php

namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Models as SysModels;
use Illuminate\Http\Request;
use Validator;

class EntController extends Controller {
  public function injection(Request $request) {
    $input = $request->all();
    Validator::make($input, [
			'user' => 'required',
			"user.openid" => 'required',
			"user.name" => 'required',
			'user.account' => 'required',
			"user.type" => 'required',
			"user.avatar" => 'required',
			"user.client_id" => 'required',
      'ent_openid' => 'required',
      'token' => 'required',
    ])->validate();

    $ent = SysModels\Ent::where('id', $input['ent_openid'])->orWhere('openid', $input['ent_openid'])->first();
    if (empty($ent)) {
      throw new \Exception('找不到企业！');
    }
    if ($ent->token != $input['token']) {
      throw new \Exception('token 授权失败!');
    }
		$options = $input['user'];
		$options['status_enum']='auditing';
		$user = SysModels\User::registerByAccount($options['type'], $options);
		
		if (!$ent->hasUser($user->id)) {
      SysModels\Ent::addUser($ent->id, $user->id, ['is_effective' => 0, 'type_enum' => 'member']);
    }
    return $this->toJson(true);
  }
}
