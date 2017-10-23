<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboTradersTable extends Migration {
	public $mdID = "bda991e010bd11e79d8a2f52bb84563e";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.trader')->comment('客商')->tableName('suite_cbo_traders');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('category', 'suite.cbo.trader.category')->nullable()->comment('分类');
		$md->entity('country', 'suite.cbo.country')->nullable()->comment('国家');
		$md->entity('province', 'suite.cbo.province')->nullable()->comment('省份');
		$md->entity('division', 'suite.cbo.division')->nullable()->comment('城市区县');
		$md->entity('area', 'suite.cbo.area')->nullable()->comment('区域');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->nullable()->comment('名称');
		$md->string('short_name')->nullable()->comment('简称');
		$md->enum('type', 'suite.cbo.trader.type.enum')->nullable()->comment('类型');
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
