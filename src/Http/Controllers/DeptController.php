<?php

namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\InputHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Suite\Cbo\Models;
use Validator;
use GAuth;
class DeptController extends Controller {
	public function index(Request $request) {
		$query = Models\Dept::with('org', 'ent', 'manager');

		$data = $query->get();

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\Dept::with('org', 'ent', 'manager');
		$data = $query->where('id', $id)->orWhere('code', $id)->first();
		return $this->toJson($data);
	}

	/**
	 * POST
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request) {
		$input = $request->all();
		$input = InputHelper::fillEntity($input, $request, ['manager', 'org']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Dept)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', GAuth::entId());
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$input['ent_id'] = GAuth::entId();

		$data = Models\Dept::create($input);

		return $this->show($request, $data->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->only(['code', 'name', 'type_enum', 'is_effective']);
		$input = InputHelper::fillEntity($input, $request, ['manager']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Dept)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', GAuth::entId());
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$oid = $request->input('org.id');
		if ($oid) {
			$input['org_id'] = $oid;
		}
		Models\Dept::where('id', $id)->update($input);
		return $this->show($request, $id);
	}
	/**
	 * DELETE
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function destroy(Request $request, $id) {
		$ids = explode(",", $id);

		Models\Dept::destroy($ids);
		return $this->toJson(true);
	}

	public function batchStore(Request $request) {
		$input = $request->all();
		$validator = Validator::make($input, [
			'datas' => 'required|array|min:1',
			'datas.*.code' => 'required',
			'datas.*.name' => 'required',
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$entId = GAuth::entId();
		$datas = $request->input('datas');
		foreach ($datas as $k => $v) {
			$data = array_only($v, ['code', 'name', 'type_enum']);
			$data = InputHelper::fillEntity($data, $v,
				[
					'org' => ['type' => Models\Org::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'manager' => ['type' => Models\Person::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
				],
				['ent_id' => $entId]
			);
			Models\Dept::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
}
