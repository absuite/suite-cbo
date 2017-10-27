<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboDataStateEnum extends Migration {
	public $mdID = "c02d18e0bb2611e7be06a1cebef1d184";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEnum('suite.cbo.data.state.enum')->comment('状态');
		$md->string('opened')->comment('开立')->default(0);
		$md->string('approve')->comment('核准中')->default(1);
		$md->string('approved')->comment('已核准')->default(2);
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
