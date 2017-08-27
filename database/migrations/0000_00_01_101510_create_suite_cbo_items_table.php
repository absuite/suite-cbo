<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboItemsTable extends Migration {
	private $mdID = "e3acbc7010bb11e7b38cc3e4aa2a6c3e";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.item')->comment('物料')->tableName('suite_cbo_items');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('category', 'suite.cbo.item.category')->nullable()->comment('分类');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->enum('form', 'suite.cbo.item.form.enum')->nullable()->comment('形态');
		$md->text('memo')->nullable()->comment('备注');
		$md->entity('currency', 'suite.cbo.currency')->nullable()->comment('币种');
		$md->decimal('price', 30, 9)->default(0)->comment('参考成本');
		$md->entity('unit', 'suite.cbo.unit')->nullable()->comment('单位');
		$md->entity('trader', 'suite.cbo.trader')->nullable()->comment('供应商');
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
