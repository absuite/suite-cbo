<?php

namespace Suite\Cbo\Http\Controllers;

use DB;
use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DtiController extends Controller {
	public function run(Request $request, $spName) {
		$dtiConnection = $request->input('connection', 'dti');
		$conn = DB::connection($dtiConnection);
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
		$params = $request->input('params');
		$cmd = "exec $spName ";
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
}
