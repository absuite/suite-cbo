<?php

namespace Suite\Cbo\Http\Controllers\Sys;

use DB;
use GAuth;
use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {
  public function getEntUsers(Request $request) {

    $query = DB::table('gmf_sys_users as u')
      ->select('u.id','u.name','u.avatar')
      ->addSelect('u.memo')
      ->whereExists(function ($query) {
        $query->select(DB::raw(1))
          ->from('gmf_sys_ent_users as eu')
          ->whereRaw('eu.user_id = u.id')
          ->where('eu.ent_id', GAuth::entId());
      });

    $data = $query->get();

    return $this->toJson($data);
  }
}
