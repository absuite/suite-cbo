<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboCountriesTable extends Migration {
	private $mdID = "e3acbaf010bb11e7b3cfa52b090ddd74";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.country')->comment('国家')->tableName('suite_cbo_countries');

		$md->string('id', 100)->primary();
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->string('short_name')->nullable()->comment('简称');
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
