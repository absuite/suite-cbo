<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboWorksTable extends Migration {
	private $mdID = "b3894cd00a9a11e7a21613e4b2686aa1";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.work')->comment('工作中心')->tableName('suite_cbo_works');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('org', 'suite.cbo.org')->nullable()->comment('组织');
		$md->entity('dept', 'suite.cbo.dept')->nullable()->comment('部门');

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
