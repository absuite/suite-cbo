<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteCboFavoritesTable extends Migration {
	private $mdID = "90ee92605fb211e7a4e91df7ba7a375e";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.cbo.favorite')->comment('收藏')->tableName('suite_cbo_favorites');

		$md->string('id', 100)->primary();

		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('user', 'gmf.sys.user')->nullable()->comment('用户');

		$md->string('src_id', 100)->nullable()->comment('来源ID');
		$md->string('src_type', 200)->nullable()->comment('来源类型');
		$md->string('src_url', 500)->nullable()->comment('来源URL');
		$md->string('title')->comment('名称');
		$md->boolean('is_revoked')->default(0)->comment('撤销');
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
