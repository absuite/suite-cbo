<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboWhsTable extends Migration {
	public $mdID = "99649d5010bf11e7af535de50d0822a3";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.wh')->comment('c')->tableName('suite_cbo_whs');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->text('memo')->nullable()->comment('备注');
		$md->entity('org', 'suite.cbo.org')->nullable()->comment('组织');
		$md->entity('dept', 'suite.cbo.dept')->nullable()->comment('部门');
		$md->entity('manager', 'suite.cbo.person')->nullable()->comment('负责人');
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
