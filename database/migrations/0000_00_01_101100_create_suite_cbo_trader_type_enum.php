<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboTraderTypeEnum extends Migration {
	private $mdID = "5f6a45409ac011e78699ab459e59e624";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);

		$md->mdEnum('suite.cbo.trader.type.enum')->comment('客商类型');
		$md->string('supplier')->comment('供应商')->default(0);
		$md->string('customer')->comment('客户')->default(1);
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
