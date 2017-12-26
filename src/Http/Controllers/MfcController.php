<?php
namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\InputHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Suite\Cbo\Models;
use Validator;
use GAuth;
class MfcController extends Controller {
	public function index(Request $request) {
		$query = Models\Mfc::with('category');

		$data = $query->get();

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\Mfc::with('category');
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
		$input = InputHelper::fillEntity($input, $request, ['category']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Mfc)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', GAuth::entId());
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}

		$input['ent_id'] = GAuth::entId();

		$data = Models\Mfc::create($input);
		return $this->show($request, $data->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->only(['code', 'name']);
		$input = InputHelper::fillEntity($input, $request, ['category']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Item)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', GAuth::entId());
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
		Models\Mfc::destroy($ids);
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
					'category' => ['type' => Models\MfcCategory::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
				],
				['ent_id' => $entId]
			);
			Models\Mfc::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
	private function importData($data, $throwExp = true) {
		$entId = GAuth::entId();
		$data = array_only($v, [
			'code', 'name', 'memo',
			'category',
		]);
		$validator = Validator::make($data, [
			'code' => 'required',
			'name' => 'required',
		]);
		if ($throwExp) {
			$validator->validate();
		} else if ($validator->fails()) {
			return false;
		}
		$data = InputHelper::fillEntity($data, $data, [
			'category' => ['type' => Models\MfcCategory::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
		],
			[
				'ent_id' => $entId,
			]
		);
		return Models\Mfc::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
	}
	public function import(Request $request) {
		$datas = app('Suite\Cbo\Bp\FileImport')->create($this, $request);
		$datas->each(function ($row, $key) {
			$this->importData($row);
		});
		return $this->toJson(true);
	}
}
