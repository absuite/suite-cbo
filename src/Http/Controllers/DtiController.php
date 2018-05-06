<?php

namespace Suite\Cbo\Http\Controllers;

use DB;
use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DtiController extends Controller {
	public function run(Request $request, $spName = '') {
		$dtiConnection = $request->input('connection', 'dti');
		$conn = DB::connection($dtiConnection);
		$spName = $spName ? $spName : $request->input('name', $spName);
		if (empty($spName)) {
			throw new \Exception('缺少name参数!');
		}

		$return = [];
		switch ($conn->getDriverName()) {
		case 'sqlsrv':
			$return = $this->runMSSQL($request, $spName, $conn);
			break;
		default:
			$return = $this->runMYSQL($request, $spName, $conn);
			break;
		}
		return $this->toJson($return);
	}
	private function runMYSQL(Request $request, $spName, $conn) {
		$params = $request->input('params');
		$cmd = "call $spName ";
		$bindValues = [];
		if ($params) {
			$first = true;
			$cmd .= '(';
			foreach ($params as $pk => $pv) {
				if (!$first) {
					$cmd .= ',';
				}
				$cmd .= '?';
				$bindValues[] = $pv;
				$first = false;
			}
			$cmd .= ')';
		}
		return $conn->select($cmd, $bindValues);
	}

	private function runMSSQL(Request $request, $spName, $conn) {
		$inputValue = $request->input('params');
		$cmd = "exec $spName ";
		$bindValues = [];
		$parmas = $this->getMSDBParams($conn, $spName);
		if ($parmas) {
			foreach ($parmas as $pk => $pv) {
				$cmd .= ($pk > 0 ? ',?' : '?');
				$bindValues[] = $this->getInputValue($pv, $inputValue);
			}
		}
		return $conn->select($cmd, $bindValues);
	}
	private function getMSDBParams($conn, $spName) {
		$cmd = "select substring(l.name,2,100) as name,lt.name as type,lt.max_length as length ";
		$cmd .= " from sys.parameters as l inner join sys.types as lt on l.system_type_id=lt.user_type_id ";
		$cmd .= " where object_id=object_id(?) Order By parameter_id ";
		return $conn->select($cmd, [$spName]);
	}
	private function getInputValue($dbParam, $inputs) {
		if (empty($dbParam) || empty($inputs)) {
			return null;
		}
		if (!empty($inputs->{$dbParam->name})) {
			return $inputs->{$dbParam->name};
		}
		if (!empty($inputs[$dbParam->name])) {
			return $inputs[$dbParam->name];
		}
		return null;
	}
}
