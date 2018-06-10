<?php

namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Suite\Cbo\Models;
use Validator;

class ItemController extends Controller {
	public function index(Request $request) {
		$size = $request->input('size', 10);
		$query = Models\Item::with('category', 'unit');
		
		return $this->toJson($query->paginate($size));
	}
	public function show(Request $request, string $id='') {
		if(empty($id)||$id=='show'){
			$id=$request->input('id');
		}
		$query = Models\Item::with('category', 'unit');
		$data = $query->where('id', $id)->orWhere('code', $id)->first();
		if ($data) {
			$data->price = round($data->price, 2);
		}
		return $this->toJson($data);
	}

	/**
	 * POST
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request) {
		$input = $request->all();
		$id= $request->input('id');
		if($id){
			$instance =Models\Item::find($id);
			$instance->fillData($input);
		}else{
			$instance =Models\Item::createFromFill($input);
			if($instance->exists()){
				throw new \Exception('已经存在!');
			}
		}				
		$instance->save();
		return $this->show($request,$instance->id);
	}
	/**
	 * PUT/PATCH
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id) {
		$input = $request->all();
		$instance =Models\Item::find($id);
		$instance->fillData($input);
		$instance->save();
		return $this->show($request, $instance->id);
	}
	/**
	 * DELETE
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function destroy(Request $request, $id) {
		$ids = explode(",", $id);
		Models\Item::destroy($ids);
		return $this->toJson(true);
	}

	public function batchStore(Request $request) {
		$input = $request->all();
		Validator::make($input, [
			'datas' => 'required|array|min:1',
			'datas.*.code' => 'required',
			'datas.*.name' => 'required',
		])->validate();
		$datas = $request->input('datas');
		Models\Item::BatchImport($datas);

		return $this->toJson(true);
	}
}
