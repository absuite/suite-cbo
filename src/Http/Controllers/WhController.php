<?php
namespace Suite\Cbo\Http\Controllers;

use GAuth;
use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\InputHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Suite\Cbo\Models;
use Validator;

class WhController extends Controller {
	public function index(Request $request) {
		$query = Models\Wh::where('id', '!=', '');

		$data = $query->get();

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\Wh::where('id', '!=', '');
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
		$input = InputHelper::fillEntity($input, $request, ['org', 'dept', 'manager']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Wh)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', GAuth::entId());
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}

		$input['ent_id'] = GAuth::entId();

		$data = Models\Wh::create($input);
		return $this->show($request, $data->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->only(['code', 'name', 'is_effective', 'org', 'dept', 'manager']);
		$input = InputHelper::fillEntity($input, $request, ['org', 'dept', 'manager']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\Wh)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', GAuth::entId());
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		Models\Wh::where('id', $id)->update($input);
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
		Models\Wh::destroy($ids);
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
			$data = array_only($v, ['code', 'name', 'memo']);
			$data = InputHelper::fillEntity($data, $v,
				[
					'org' => ['type' => Models\Org::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'dept' => ['type' => Models\Dept::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
					'manager' => ['type' => Models\Person::class, 'matchs' => ['code', 'ent_id' => '${ent_id}']],
				],
				['ent_id' => $entId]
			);
			Models\Wh::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
		}
		return $this->toJson(true);
	}
}
