<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboItemFormEnum extends Migration {
	public $mdID = "850a370049f911e7b39231d504ea9bb6";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);

		$md->mdEnum('suite.cbo.item.form.enum')->comment('料品形态');
		$md->string('entity')->comment('实体')->default(0);
		$md->string('service')->comment('服务')->default(1);
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
