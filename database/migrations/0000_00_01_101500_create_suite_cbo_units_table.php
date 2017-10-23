<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboUnitsTable extends Migration {
	public $mdID = "e3acb84010bb11e7908add884c5fd68b";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.unit')->comment('计量单位')->tableName('suite_cbo_units');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->enum('type', 'suite.cbo.unit.type.enum')->nullable()->comment('分组');
		$md->string('round_precision')->default(0)->comment('精度');
		$md->string('round_value')->default(0)->comment('舍入值');
		$md->enum('round_type', 'suite.cbo.round.type.enum')->nullable()->comment('舍入类型');
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
