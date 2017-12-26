<?php

namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\InputHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Suite\Cbo\Models;
use Validator;
use GAuth;
class DivisionController extends Controller {
	public function index(Request $request) {
		$query = Models\Division::with('country', 'province', 'area');

		$data = $query->get();

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\Division::with('country', 'province', 'area');
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
		$input = InputHelper::fillEntity($input, $request, ['country', 'province', 'area']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Division)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', GAuth::entId());
				}),
			],
		]);
		$input['ent_id'] = GAuth::entId();
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$data = Models\Division::create($input);
		return $this->show($request, $data->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->only(['code', 'name', 'short_name', 'is_effective']);
		$input = InputHelper::fillEntity($input, $request, ['country', 'province', 'area']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Division)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', GAuth::entId());
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		Models\Division::where('id', $id)->update($input);
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
		Models\Division::destroy($ids);
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
			$data = array_only($v, ['code', 'name', 'short_name']);
			$data = InputHelper::fillEntity($data, $v,
				[
					'area' => ['type' => Models\Area::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'province' => ['type' => Models\Province::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'country' => ['type' => Models\Country::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
				],
				['ent_id' => $entId]
			);
			Models\Division::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
}
