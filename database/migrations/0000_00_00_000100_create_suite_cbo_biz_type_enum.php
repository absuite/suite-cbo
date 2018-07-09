<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboBizTypeEnum extends Migration {
	public $mdID = "95dabe8017ef11e7a6f4b3b3519e83cb";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEnum('suite.cbo.biz.type.enum')->comment('业务类型');
		$md->string('ship')->comment('出货')->default(0);
		$md->string('rcv')->comment('收货')->default(1);
		$md->string('miscRcv')->comment('库存杂收')->default(2);
		$md->string('miscShip')->comment('库存杂发')->default(3);
		$md->string('transfer')->comment('库存调拨')->default(4);
		$md->string('moRcv')->comment('生产入库')->default(5);
		$md->string('moIssue')->comment('生产领料')->default(6);
		$md->string('process')->comment('工序转移')->default(7);
		$md->string('receivables')->comment('收款')->default(8);
		$md->string('payment')->comment('付款')->default(9);
		$md->string('ar')->comment('应收')->default(10);
		$md->string('ap')->comment('应付')->default(11);
		$md->string('sale_settle')->comment('委托代销结算清单')->default(12);
		$md->string('sale_ship')->comment('销售出货')->default(13);

		$md->string('plan')->comment('计划预算')->default(14);
		$md->string('expense')->comment('费用报销')->default(15);
		$md->string('voucher')->comment('收支凭证')->default(16);
		$md->string('waste')->comment('废品')->default(17);
		$md->string('reject')->comment('不良品')->default(18);
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
