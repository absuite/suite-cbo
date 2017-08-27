<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboProjectsTable extends Migration {
	private $mdID = "9964a3e010bf11e786789190fc7362b3";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.project')->comment('项目')->tableName('suite_cbo_projects');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('category', 'suite.cbo.project.category')->nullable()->comment('分类');
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
