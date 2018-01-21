<?php
namespace Suite\Cbo\Http\Controllers;

use GAuth;
use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
		$data = $query->where('id', $id)->first();
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
			'code' => 'required',
			'name' => 'required',
			'biz_type_enum' => 'required',
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}

		$input['ent_id'] = GAuth::entId();
		$data = Models\DocType::updateOrCreate(['ent_id' => $input['ent_id'], 'biz_type_enum' => $input['biz_type_enum'], 'code' => $input['code']], $input);

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
			'code' => 'required',
			'name' => 'required',
			'biz_type_enum' => 'required',
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$input['ent_id'] = GAuth::entId();
		$data = Models\DocType::updateOrCreate(['ent_id' => $input['ent_id'], 'biz_type_enum' => $input['biz_type_enum'], 'code' => $input['code']], $input);

		return $this->show($request, $data->id);
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
			'datas.*.biz_type_enum' => 'required',
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$entId = GAuth::entId();
		$datas = $request->input('datas');
		foreach ($datas as $k => $v) {
			$data = array_only($v, ['code', 'name', 'biz_type_enum']);
			Models\DocType::updateOrCreate(['ent_id' => $entId, 'biz_type_enum' => $data['biz_type_enum'], 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}

}
