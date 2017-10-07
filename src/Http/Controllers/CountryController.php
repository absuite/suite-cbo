<?php

namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Suite\Cbo\Models;
use Validator;

class CountryController extends Controller {
	public function index(Request $request) {
		$query = Models\Country::where('id', '!=', '');

		$data = $query->paginate($request->input('size', 10));

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\Country::where('id', '!=', '');
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
		$validator = Validator::make($input, [
			'code' => [
				'required',
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$data = Models\Country::create($input);
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
		$validator = Validator::make($input, [
			'code' => [
				'required',
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		Models\Country::where('id', $id)->update($input);
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
		Models\Country::destroy($ids);
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
		$datas = $request->input('datas');
		foreach ($datas as $k => $v) {
			$data = array_only($v, ['code', 'name', 'short_name']);
			Models\Country::updateOrCreate(['code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
}
