<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboUnitTypeEnum extends Migration {
	public $mdID = "dd4ef8c0483411e78c5e3f4631c8364e";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		//时间，长度，重量，面积，体积，数量
		$md->mdEnum('suite.cbo.unit.type.enum')->comment('单位类型');
		$md->string('time')->comment('时间')->default(0);
		$md->string('length')->comment('长度')->default(1);
		$md->string('weight')->comment('重量')->default(2);
		$md->string('area')->comment('面积')->default(3);
		$md->string('volume')->comment('体积')->default(4);
		$md->string('quantity')->comment('数量')->default(5);
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
