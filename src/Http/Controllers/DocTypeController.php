<?php
namespace Suite\Cbo\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Suite\Cbo\Models;
use Validator;

class DocTypeController extends Controller {
	public function index(Request $request) {
		$size = $request->input('size', 10);
		$query = Models\DocType::where('id', '!=', '');
		return $this->toJson($query->paginate($size));
	}
	public function show(Request $request, string $id='') {
		if(empty($id)||$id=='show'){
			$id=$request->input('id');
		}
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
		$id= $request->input('id');
		if($id){
			$instance =Models\DocType::find($id);
			$instance->fillData($input);
		}else{
			$instance =Models\DocType::createFromFill($input);
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
		$instance =Models\DocType::find($id);
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
		Models\DocType::destroy($ids);
		return $this->toJson(true);
	}
	public function batchStore(Request $request) {
		$input = $request->all();
		Validator::make($input, [
			'datas' => 'required|array|min:1',
			'datas.*.code' => 'required',
			'datas.*.name' => 'required',
			'datas.*.biz_type_enum' => 'required',
		])->validate();
		$datas = $request->input('datas');
		foreach ($datas as $k => $v) {
			Models\DocType::fromImportItem($v);
		}
		return $this->toJson(true);
	}

}
