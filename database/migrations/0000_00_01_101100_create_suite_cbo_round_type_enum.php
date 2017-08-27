<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboRoundTypeEnum extends Migration {
	private $mdID = "d16abc302b7311e79ff65fec58451bff";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEnum('suite.cbo.round.type.enum')->comment('舍入类型');
		$md->string('add')->comment('全部进位')->default(0);
		$md->string('delete')->comment('全部舍位')->default(1);
		$md->string('round')->comment('按值舍入')->default(2);
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
