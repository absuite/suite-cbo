<?php
namespace Suite\Cbo\Http\Controllers;

use GAuth;
use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Suite\Cbo\Models;
use Validator;

class TraderCategoryController extends Controller {
	public function index(Request $request) {
		$query = Models\TraderCategory::where('id', '!=', '');

		$data = $query->get();

		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\TraderCategory::where('id', '!=', '');
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
		$data = Models\TraderCategory::fromImportItem($input);
		return $this->show($request, $data->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->all();
		Models\TraderCategory::fromImportItem($input, $id);
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
		Models\TraderCategory::destroy($ids);
		return $this->toJson(true);
	}

	public function batchStore(Request $request) {
		$input = $request->all();
		Validator::make($input, [
			'datas' => 'required|array|min:1',
			'datas.*.code' => 'required',
			'datas.*.name' => 'required',
		])->validate();
		$entId = GAuth::entId();
		$datas = $request->input('datas');
		foreach ($datas as $k => $v) {
			Models\TraderCategory::fromImportItem($v);
		}
		return $this->toJson(true);
	}
}
