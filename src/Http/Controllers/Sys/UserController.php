<?php

namespace Suite\Cbo\Http\Controllers\Sys;

use DB;
use GAuth;
use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Http\Resources\User as SysUserRes;
use Gmf\Sys\Models\Ent\EntUser;
use Illuminate\Http\Request;
use Suite\Cbo\Http\Resources\User as UserRes;
use Validator;

class UserController extends Controller {
  public function getEntUsers(Request $request) {
    $size = $request->input('size', 20);

    $query = EntUser::with('user')->where('ent_id', GAuth::entId());
    $query->orderBy('is_effective','desc');
    $query->orderBy('created_at', 'desc');
    $query->orderBy('id', 'desc');
    return $this->toJson(UserRes::collection($query->paginate($size)));
  }
  public function postCreate(Request $request) {
    $input = $request->all();
    Validator::make($input, [
      'name' => 'required',
      'account' => 'required',
    ])->validate();
    $input['client_id'] = config('gmf.client.id');
    $user = config('gmf.user.model')::registerByAccount('web', $input);
    $em = config('gmf.ent.model')::addUser(GAuth::entId(), $user->id);

    return $this->toJson(new UserRes($em));
  }
  public function setDisabled(Request $request) {
    $ids = $request->input('ids');
    if ($ids) {
      $ids = explode(',', $ids);
      DB::table('gmf_sys_ent_users')->where('ent_id', GAuth::entId())->whereIn('user_id', $ids)->update(['is_effective' => '0']);
    }
    return $this->toJson(true);
  }
  public function setEffective(Request $request) {
    $ids = $request->input('ids');
    if ($ids) {
      $ids = explode(',', $ids);
      DB::table('gmf_sys_ent_users')->where('ent_id', GAuth::entId())->whereIn('user_id', $ids)->update(['is_effective' => '1']);
    }
    return $this->toJson(true);
  }
  public function postChecker(Request $request) {
    $em = app('Gmf\Sys\Bp\UserAuth')->isExists($request->all());
    if ($em) {
      return $this->toJson(new SysUserRes($em));
    } else {
      return $this->toJson(false);
    }
  }
  public function postJoin(Request $request) {
    $em = false;
    $user = app('Gmf\Sys\Bp\UserAuth')->isExists($request->only('id', 'account'));
    if (empty($user)) {
      throw new \Exception('用户信息查找失败!');
    }
    $em = config('gmf.ent.model')::addUser(GAuth::entId(), $user->id);
    return $this->toJson(new UserRes($em));

  }
  public function show(Request $request, $id) {
    $item = EntUser::with('user')->where('ent_id', GAuth::entId())->where('user_id', $id)->first();
    return $this->toJson(new UserRes($item));
  }
  public function setPassword(Request $request) {
    $input = $request->all();
    Validator::make($input, [
      'id' => 'required',
      'password' => 'required',
    ])->validate();

    $id = $input['id'];
    $item = EntUser::where('ent_id', GAuth::entId())->where('user_id', $id)->first();
    $user = config('gmf.user.model')::find($item->user_id);
    $user->resetPassword($input['password']);
    return $this->show($request, $id);
  }
  public function setInfos(Request $request) {
    $input = $request->all();
    Validator::make($input, [
      'id' => 'required',
    ])->validate();

    $id = $input['id'];
    $item = EntUser::where('ent_id', GAuth::entId())->where('user_id', $id)->first();
    $user = config('gmf.user.model')::where('id', $id)->update(array_only($input, ['name', 'nick_name']));
    return $this->show($request, $id);
  }
}
