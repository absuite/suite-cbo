<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboDeptsTable extends Migration {
	public $mdID = "a4f975b00a9911e789cc1d16fbec3ad4";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.dept')->comment('部门')->tableName('suite_cbo_depts');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('org', 'suite.cbo.org')->nullable()->comment('组织');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->enum('type', 'suite.cbo.dept.type.enum')->nullable()->comment('部门属性');
		$md->entity('manager', 'suite.cbo.person')->nullable()->comment('负责人');
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
