<?php

namespace Suite\Cbo\Bp;
use Excel;
use Gmf\Sys\Http\Controllers\Controller as BPListener;
use Gmf\Sys\Models\File;
use Illuminate\Http\Request;
use Storage;

class FileImport {
	public function create(BPListener $observer, Request $request) {
		$files = File::storage($request, 'files', 'import', 'local');
		$datas = collect([]);
		if ($files) {
			foreach ($files as $key => $file) {
				$disk = Storage::disk($file->disk);
				$path = $disk->path($file->path);
				Excel::load($path, function ($reader) use ($request, $datas) {
					$results = $reader->all();
					foreach ($results as $sheet) {
						$columns = array_where($sheet->getHeading(), function ($value) {
							return is_string($value) && $value;
						});
						$rowsData = [];
						foreach ($sheet as $key => $row) {
							if ($key > 0 && !empty($row->key)) {
								$datas->push($row->only($columns)->all());
							}
						}
					}
				});
			}
		}
		return $datas;
	}
}
