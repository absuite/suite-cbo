<?php

namespace Suite\Cbo\Http\Controllers;

use GAuth;
use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\InputHelper;
use Gmf\Sys\Models;
use Illuminate\Http\Request;
use Validator;

class DtiController extends Controller {

	public function importCategories(Request $request) {
		$datas = app('Suite\Cbo\Bp\FileImport')->create($this, $request);
		$datas->each(function ($row, $key) {
			$this->importCategoriesData($row);
		});
		return $this->toJson(true);
	}
	public function importParams(Request $request) {
		$datas = app('Suite\Cbo\Bp\FileImport')->create($this, $request);
		$datas->each(function ($row, $key) {
			$this->importParamsData($row);
		});
		return $this->toJson(true);
	}
	public function importItems(Request $request) {
		$datas = app('Suite\Cbo\Bp\FileImport')->create($this, $request);
		$datas->each(function ($row, $key) {
			$this->importItemsData($row);
		});
		return $this->toJson(true);
	}

	private function importCategoriesData($data, $throwExp = true) {
		$entId = GAuth::entId();
		$data = array_only($data, [
			'code', 'name', 'host',
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
		return Models\DtiCategory::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
	}
	private function importParamsData($data, $throwExp = true) {
		$entId = GAuth::entId();
		$data = array_only($data, [
			'code', 'name', 'type_enum', 'value', 'category', 'dti',
		]);
		$validator = Validator::make($data, [
			'code' => 'required',
			'name' => 'required',
			'type_enum' => 'required',
		]);
		if ($throwExp) {
			$validator->validate();
		} else if ($validator->fails()) {
			return false;
		}
		$data = InputHelper::fillEntity($data, $data,
			[
				'category' => function ($v, $data) use ($entId) {
					return Models\DtiCategory::where('ent_id', $entId)->where(function ($query) use ($v) {
						$query->where('code', $v)->orWhere('name', $v);
					})->value('id');
				},
				'dti' => function ($v, $data) use ($entId) {
					return Models\Dti::where('ent_id', $entId)->where(function ($query) use ($v) {
						$query->where('code', $v)->orWhere('name', $v);
					})->where('category_id', $data['category_id'])->value('id');
				},
			],
			['ent_id' => $entId]
		);
		return Models\DtiParam::updateOrCreate(['ent_id' => $entId, 'code' => $data['code']], $data);
	}
	private function importItemsData($data, $throwExp = true) {
		$entId = GAuth::entId();
		$data = array_only($data, [
			'code', 'name', 'method_enum', 'path', 'header', 'body', 'query', 'local', 'category',
		]);
		$validator = Validator::make($data, [
			'code' => 'required',
			'name' => 'required',
			'category' => 'required',
			'local' => 'required',
		]);
		if ($throwExp) {
			$validator->validate();
		} else if ($validator->fails()) {
			return false;
		}
		$data = InputHelper::fillEntity($data, $data,
			[
				'category' => function ($v, $data) use ($entId) {
					return Models\DtiCategory::where('ent_id', $entId)->where(function ($query) use ($v) {
						$query->where('code', $v)->orWhere('name', $v);
					})->value('id');
				},
				'local' => function ($v, $data) {
					return Models\DtiLocal::where('code', $v)->orWhere('name', $v)->value('id');
				},
			],
			['ent_id' => $entId]
		);
		return Models\Dti::updateOrCreate(['ent_id' => $entId, 'category_id' => $data['category_id'], 'code' => $data['code']], $data);
	}
}
