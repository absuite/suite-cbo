<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboAreasTable extends Migration {
	public $mdID = "e3acbb6010bb11e79c6b29ab7ef5c70b";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.area')->comment('区域')->tableName('suite_cbo_areas');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('country', 'suite.cbo.country')->nullable()->comment('国家/地区');
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
