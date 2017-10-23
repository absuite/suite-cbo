<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboPeriodAccountsTable extends Migration {
	public $mdID = "1a944fa010bf11e7bba123b2639a9ea5";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.period.account')->comment('会计期间')->tableName('suite_cbo_period_accounts');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('calendar', 'suite.cbo.period.calendar')->nullable()->comment('会计日历');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->integer('year')->default(0)->comment('年');
		$md->integer('month')->default(0)->comment('月');
		$md->integer('week')->default(0)->comment('周');
		$md->text('memo')->nullable()->comment('备注');
		$md->dateTime('from_date')->nullable()->comment('开始日期');
		$md->dateTime('to_date')->nullable()->comment('结束日期');
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
