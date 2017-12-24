<?php
namespace Suite\Cbo\Http\Controllers;

use GAuth;
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

		$input['ent_id'] = $request->oauth_ent_id;
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
		$input['ent_id'] = $request->oauth_ent_id;
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
		$entId = $request->oauth_ent_id;
		$datas = $request->input('datas');
		foreach ($datas as $k => $v) {
			$data = array_only($v, ['code', 'name', 'biz_type_enum']);
			Models\DocType::updateOrCreate(['ent_id' => $entId, 'biz_type_enum' => $data['biz_type_enum'], 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
	private function importData($data, $throwExp = true) {
		$entId = GAuth::entId();
		$validator = Validator::make($data, [
			'code' => 'required',
			'name' => 'required',
			'biz_type_enum' => [
				'required',
				Rule::in(['ship', 'rcv',
					'miscRcv', 'miscShip',
					'transfer', 'moRcv', 'moIssue',
					'process', 'receivables', 'payment',
					'ar', 'ap', 'plan',
					'expense', 'voucher']),
			],
		]);
		if ($throwExp) {
			$validator->validate();
		} else if ($validator->fails()) {
			return false;
		}
		return Models\DocType::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
	}
	public function import(Request $request) {
		$datas = app('Suite\Cbo\Bp\FileImport')->create($this, $request);
		$datas->each(function ($row, $key) {
			$this->importData($row);
		});
		return $this->toJson(true);
	}
}
