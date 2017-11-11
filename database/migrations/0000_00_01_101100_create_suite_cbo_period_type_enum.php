<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboPeriodTypeEnum extends Migration {
	public $mdID = "79cf667010c011e7a63bad243a3436a0";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEnum('suite.cbo.period.type.enum')->comment('期间类型');
		$md->string('months')->comment('月')->default(0);
		// $md->string('quarters')->comment('季')->default(1);
		$md->string('weeks')->comment('周')->default(1);
		// $md->string('years')->comment('年')->default(1);
		$md->string('days')->comment('日')->default(1);
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
