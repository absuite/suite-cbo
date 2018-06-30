<?php

namespace Suite\Cbo\Http\Controllers;

use GAuth;
use Gmf\Sys\Builder;
use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Models as SysModels;
use Illuminate\Http\Request;
use Suite\Amiba\Models as AmibaModels;
use Suite\Cbo\Models as CboModels;

class DashboardController extends Controller {
	public function getMedia(Request $request) {
		$rtn = new Builder;
		$value = CboModels\Org::where('ent_id', GAuth::entId())->count();
		$rtn->orgs($value);
		$rtn->groups(AmibaModels\Group::where('ent_id', GAuth::entId())->count());
		$rtn->users(SysModels\Ent\EntUser::where('ent_id', GAuth::entId())->count());

		$value = AmibaModels\DataAccounting::where('ent_id', GAuth::entId())->max('created_at');
		$rtn->account_time(empty($value) ? '无' : date_format(new \DateTime($value), 'Y/m/d H:i'));

		$value = SysModels\DtiLog::where('ent_id', GAuth::entId())->max('created_at');
		$rtn->dti_time(empty($value) ? '无' : date_format(new \DateTime($value), 'Y/m/d H:i'));
		return $this->toJson($rtn);
	}
}
