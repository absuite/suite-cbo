<?php
namespace Suite\Cbo\Http\Controllers;

use Suite\Cbo\Models;
use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\InputHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class PeriodAccountController extends Controller {
	public function index(Request $request) {
		$query = Models\PeriodAccount::orderBy('from_date');
		if ($request->input('calendar')) {
			$query->where('calendar_id', $request->input('calendar'));
		}
		$data = $query->get();

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\PeriodAccount::orderBy('from_date');
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
		$input = InputHelper::fillEntity($input, $request, ['calendar']);
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\PeriodAccount)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
			'name' => [
				'required',
				Rule::unique((new Models\PeriodAccount)->getTable())->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}

		$input['ent_id'] = $request->oauth_ent_id;

		$data = Models\PeriodAccount::create($input);
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
		$validator = Validator::make($input, [
			'code' => [
				'required',
				Rule::unique((new Models\PeriodAccount)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
			'name' => [
				'required',
				Rule::unique((new Models\PeriodAccount)->getTable())->ignore($id)->where(function ($query) use ($request) {
					$query->where('ent_id', $request->oauth_ent_id);
				}),
			],
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		Models\PeriodAccount::where('id', $id)->update($input);
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
		if (count($ids)) {
			$data = Models\PeriodAccount::orderBy('from_date')->whereIn('id', $ids)->first();
			Models\PeriodAccount::where('from_date', '>=', $data->from_date)
				->where('calendar_id', $data->calendar_id)
				->delete();
		}
		return $this->toJson(true);
	}

	public function batchStore(Request $request) {
		$input = $request->all();
		$validator = Validator::make($input, [
			'datas' => 'required|array|min:1',
			'datas.*.code' => 'required',
			'datas.*.calendar' => 'required',
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$entId = $request->oauth_ent_id;
		$datas = $request->input('datas');
		foreach ($datas as $k => $v) {
			$data = array_only($v, ['year', 'month', 'week', 'code', 'name', 'from_date', 'to_date']);
			$data = InputHelper::fillEntity($data, $v, ['calendar']);
			Models\PeriodAccount::updateOrCreate(['ent_id' => $entId, 'code' => $data['code'], 'calendar_id' => $data['calendar_id']], $data);
		}
		return $this->toJson(true);
	}
}
