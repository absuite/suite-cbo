<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboDeptTypeEnum extends Migration {
	public $mdID = "8c1bdf50483211e7b46b713256f1becc";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		//管理、生产、销售、采购、研发、服务
		$md->mdEnum('suite.cbo.dept.type.enum')->comment('部门属性');
		$md->string('manage')->comment('管理')->default(0);
		$md->string('produce')->comment('生产')->default(1);
		$md->string('sale')->comment('销售')->default(2);
		$md->string('purchase')->comment('采购')->default(3);
		$md->string('development')->comment('研发')->default(4);
		$md->string('service')->comment('服务')->default(5);
		$md->string('other')->comment('其它')->default(6);
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
