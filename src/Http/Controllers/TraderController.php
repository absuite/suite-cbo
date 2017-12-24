<?php
namespace Suite\Cbo\Http\Controllers;

use GAuth;
use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\InputHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Suite\Cbo\Models;
use Validator;

class TraderController extends Controller {
	public function index(Request $request) {
		$query = Models\Trader::with('category');
		$data = $query->get();
		return $this->toJson($data);
	}

	public function show(Request $request, string $id) {
		$query = Models\Trader::with('category', 'country', 'province', 'division', 'area');
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
		$input = InputHelper::fillEntity($input, $request, ['category', 'country', 'province', 'division', 'area']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Trader)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}

		$input['ent_id'] = $request->oauth_ent_id;
		$data = Models\Trader::create($input);
		return $this->show($request, $data->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->only(['code', 'name', 'short_name', 'type_enum', 'is_effective', 'memo']);
		$input = InputHelper::fillEntity($input, $request, ['category', 'country', 'province', 'division', 'area']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Trader)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		Models\Trader::where('id', $id)->update($input);
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
		Models\Trader::destroy($ids);
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
			$data = array_only($v, ['code', 'name', 'type_enum']);
			$data = InputHelper::fillEntity($data, $v,
				[
					'category' => ['type' => Models\TraderCategory::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'area' => ['type' => Models\Area::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'country' => ['type' => Models\Country::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'province' => ['type' => Models\Province::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'division' => ['type' => Models\Division::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
				],
				['ent_id' => $entId]
			);
			Models\Trader::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
	private function importData($data, $throwExp = true) {
		$entId = GAuth::entId();
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
			'category' => ['type' => Models\TraderCategory::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
		],
			[
				'ent_id' => $entId,
			]
		);
		return Models\Trader::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
	}
	public function import(Request $request) {
		$datas = app('Suite\Cbo\Bp\FileImport')->create($this, $request);
		$datas->each(function ($row, $key) {
			$this->importData($row);
		});
		return $this->toJson(true);
	}
}
