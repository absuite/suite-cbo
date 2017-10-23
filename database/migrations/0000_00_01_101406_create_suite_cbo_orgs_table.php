<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboOrgsTable extends Migration {
	public $mdID = "a4f971600a9911e78c6d455afda86b5d";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.org')->comment('组织')->tableName('suite_cbo_orgs');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->entity('manager', 'suite.cbo.person')->nullable()->comment('负责人');
		$md->string('short_name')->nullable()->comment('简称');
		$md->text('memo')->nullable()->comment('备注');
		$md->string('avatar')->nullable()->comment('图标');
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
