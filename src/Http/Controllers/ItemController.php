<?php

namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\InputHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Suite\Cbo\Models;
use Validator;

class ItemController extends Controller {
	public function index(Request $request) {
		$query = Models\Item::with('category', 'unit');

		$data = $query->get();

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\Item::with('category', 'unit');
		$data = $query->where('id', $id)->orWhere('code', $id)->first();
		if ($data) {
			$data->price = round($data->price, 2);
		}
		return $this->toJson($data);
	}

	/**
	 * POST
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request) {
		$input = $request->all();
		$input = InputHelper::fillEntity($input, $request, ['category', 'currency', 'trader', 'unit']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Item)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$input['ent_id'] = $request->oauth_ent_id;

		$data = Models\Item::create($input);
		return $this->show($request, $data->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->only(['code', 'name', 'memo', 'form_enum']);
		$input = InputHelper::fillEntity($input, $request, ['category', 'currency', 'trader', 'unit']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Item)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		Models\Item::where('id', $id)->update($input);
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
		Models\Item::destroy($ids);
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
		$entId = $request->oauth_ent_id;
		$datas = $request->input('datas');
		foreach ($datas as $k => $v) {
			$data = array_only($v, ['code', 'name', 'memo', 'form_enum']);
			$data = InputHelper::fillEntity($data, $v,
				[
					'currency' => ['type' => Models\Currency::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'category' => ['type' => Models\ItemCategory::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'unit' => ['type' => Models\Unit::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'trader' => ['type' => Models\Trader::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
				],
				['ent_id' => $entId]
			);
			Models\Item::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
}
