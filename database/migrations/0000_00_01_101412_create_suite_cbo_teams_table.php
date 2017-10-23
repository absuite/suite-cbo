<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboTeamsTable extends Migration {
	public $mdID = "bfd5f8a00a9a11e7899dfb676b00c09c";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.team')->comment('班组')->tableName('suite_cbo_teams');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('org', 'suite.cbo.org')->nullable()->comment('组织');
		$md->entity('dept', 'suite.cbo.dept')->nullable()->comment('部门');
		$md->entity('work', 'suite.cbo.work')->nullable()->comment('工作中心');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
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
