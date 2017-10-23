<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboProvincesTable extends Migration {
	public $mdID = "d39bc4804a4d11e7ae1b0ba17a131387";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.province')->comment('省份')->tableName('suite_cbo_provinces');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('country', 'suite.cbo.country')->nullable()->comment('国家/地区');
		$md->entity('area', 'suite.cbo.area')->nullable()->comment('区域');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->string('short_name')->nullable()->comment('简称');
		$md->boolean('is_effective')->default(1)->comment('生效的');
		$md->timestamps();

		$md->build();

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Metadata::dropIfExists($this->mdID);
	}
}
