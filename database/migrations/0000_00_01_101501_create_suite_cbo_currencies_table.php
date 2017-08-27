<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboCurrenciesTable extends Migration {
	private $mdID = "e3acba6010bb11e7bc2cc9ce0de9d1d7";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.currency')->comment('币种')->tableName('suite_cbo_currencies');

		$md->string('id', 100)->primary();
		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->string('code')->nullable()->comment('编码');
		$md->string('name')->comment('名称');
		$md->string('symbol')->nullable()->comment('货币符号');
		$md->string('money_round_precision')->default(2)->comment('精度');
		$md->string('money_round_value')->nullable()->comment('舍入值');
		$md->enum('money_round_type', 'suite.cbo.round.type.enum')->nullable()->comment('舍入类型');
		$md->string('price_round_precision')->default(2)->comment('精度');
		$md->string('price_round_value')->nullable()->comment('舍入值');
		$md->enum('price_roundtype', 'suite.cbo.round.type.enum')->nullable()->comment('舍入类型');
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
