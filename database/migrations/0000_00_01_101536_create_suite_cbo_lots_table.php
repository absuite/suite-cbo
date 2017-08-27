<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboLotsTable extends Migration {
	private $mdID = "e54831e010bf11e7a1ffcf724b21119d";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.lot')->comment('批号')->tableName('suite_cbo_lots');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->text('memo')->nullable()->comment('备注');
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
