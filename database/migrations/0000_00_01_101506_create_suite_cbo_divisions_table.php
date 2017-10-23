<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboDivisionsTable extends Migration {
	public $mdID = "e3acbbc010bb11e78998758c98ab8bef";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.division')->comment('城市区县')->tableName('suite_cbo_divisions');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('country', 'suite.cbo.country')->nullable()->comment('国家');
		$md->entity('area', 'suite.cbo.area')->nullable()->comment('区域');
		$md->entity('province', 'suite.cbo.province')->nullable()->comment('省份');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->string('short_name')->nullable()->comment('简称');
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
