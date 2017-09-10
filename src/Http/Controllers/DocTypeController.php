<?php
namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Suite\Cbo\Models;
use Validator;

class DocTypeController extends Controller {
	public function index(Request $request) {
		$query = Models\DocType::where('id', '!=', '');

		$data = $query->get();

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\DocType::where('id', '!=', '');
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
				Rule::unique((new Models\DocType)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
			'name' => [
				'required',
				Rule::unique((new Models\DocType)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}

		$input['ent_id'] = $request->oauth_ent_id;

		$data = Models\DocType::create($input);
		return $this->show($request, $data->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->only(['code', 'name', 'biz_type_enum']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\DocType)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
			'name' => [
				'required',
				Rule::unique((new Models\DocType)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		Models\DocType::where('id', $id)->update($input);
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
		Models\DocType::destroy($ids);
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
			$data = array_only($v, ['code', 'name', 'biz_type_enum']);
			Models\DocType::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
}
