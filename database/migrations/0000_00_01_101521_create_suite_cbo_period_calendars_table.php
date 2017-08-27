<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboPeriodCalendarsTable extends Migration {
	private $mdID = "bda995a010bd11e784004709dc88d08e";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.period.calendar')->comment('会计日历')->tableName('suite_cbo_period_calendars');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->enum('type', 'suite.cbo.period.type.enum')->comment('期间类型');
		$md->integer('unit')->default(1)->comment('时隔');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
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
