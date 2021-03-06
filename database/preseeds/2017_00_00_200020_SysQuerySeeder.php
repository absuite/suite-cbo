<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SysQuerySeeder extends Seeder {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {

		$exception = DB::transaction(function () {
			$id = "9314a2100a6211e79036095742576697";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.language.list')->entity('gmf.sys.language')
					->fields(['id', 'code' => '编码', 'name' => '名称', 'memo' => '备注']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});
			$id = "6a1c80700a6911e7bee9dbc30ca2b914";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.ent.list')->entity('gmf.sys.ent')
					->fields(['id', 'code' => '编码', 'name' => '名称', 'memo' => '备注']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.id in (select ent_id from gmf_sys_ent_users where user_id=#{userId}#)');
			});

			$id = "358d5410101e11e7b7a11dd8f04ef838";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.profile.list')->entity('gmf.sys.profile')
					->fields(['id', 'code' => '编码', 'name' => '名称', 'memo' => '备注']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});

			$id = "358d5890101e11e786ecab74d6de29d1";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.user.list')->entity('gmf.sys.user')
					->fields(['id', 'code' => '编码', 'name' => '名称', 'memo' => '备注']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});

			$id = "358d5a00101e11e784537304083cfce7";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.menu.list')->entity('gmf.sys.menu')
					->fields(['id', 'code' => '编码', 'name' => '名称', 'memo' => '备注']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});

			$id = "358d5a60101e11e78ec0db73b56a7b9b";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.entity.list')->entity('gmf.sys.entity')
					->fields(['id', 'name' => '名称', 'comment' => '备注']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});

			$id = "358d5b00101e11e78cd947f3d0f5ddf9";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.component.list')->entity('gmf.sys.component')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});

			$id = "358d5ba0101e11e790ddd5e5a1599278";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.query.list')->entity('gmf.sys.query')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});

			$id = "7835ccd063b311e785f025559899f449";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.dti.category.list')->entity('gmf.sys.dti.category')
					->fields(['id', 'code', 'name', 'host']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "82181ce09ab911e7ab870b9c8d3a3e1b";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.dti.param.list')->entity('gmf.sys.dti.param')
					->fields(['id', 'category.name', 'dti.name', 'code', 'name', 'type_enum', 'value']);
				$builder->orders(['category.code', 'dti.code', 'code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "b7609c2062e111e7821eb75781824e97";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.dti.list')->entity('gmf.sys.dti')
					->fields(['id', 'category.name', 'local.name', 'code', 'name', 'method_enum', 'path', 'body', 'header']);
				$builder->orders(['category.code', 'local.code', 'code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "6d8961009b9311e7b892f9f5b12cd8b3";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.dti.local.list')->entity('gmf.sys.dti.local')
					->fields(['id', 'code', 'name', 'method_enum', 'path', 'body', 'header']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});

			$id = "b7609e7062e111e7a78045214e863a8c";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.dti.log.list')->entity('gmf.sys.dti.log')
					->fields(['id', 'dti.category.name', 'dti.local.name', 'dti.name', 'memo', 'state_enum', 'created_at', 'content', 'session']);
				$builder->orders(['created_at' => 'desc', 'session' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "358d5930101e11e7a340b9b3adb85586";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.authority.role.list')->entity('gmf.sys.authority.role')
					->fields(['id', 'code' => '编码', 'name' => '名称', 'memo' => '备注']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "358d59a0101e11e7826f7fee83931186";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.authority.permit.list')->entity('gmf.sys.authority.permit')
					->fields(['id', 'code' => '编码', 'name' => '名称', 'memo' => '备注']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "d6a63fb0b0a211e7924e5b73ed5b89b2";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.authority.role.user.list')->entity('gmf.sys.authority.role.user')
					->fields(['id', 'role.name', 'user.name', 'is_revoked']);
				$builder->orders(['role.name', 'user.name', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "d6a641a0b0a211e7b96661210d393983";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.authority.role.menu.list')->entity('gmf.sys.authority.role.menu')
					->fields(['id', 'role.name', 'menu.name', 'is_revoked']);
				$builder->orders(['role.name', 'menu.name', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "d6a64240b0a211e7b75ddb667ff64ce3";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.authority.role.entity.list')->entity('gmf.sys.authority.role.entity')
					->fields(['id', 'role.name', 'entity.comment','data_name', 'filter', 'operation_enum', 'is_revoked']);
				$builder->orders(['role.name', 'entity.name', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "d6a642c0b0a211e7aaeac7cf8a40b86c";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('gmf.sys.authority.role.permit.list')->entity('gmf.sys.authority.role.permit')
					->fields(['id', 'role.name', 'permit.name', 'opinion_enum', 'is_revoked']);
				$builder->orders(['role.name', 'permit.name', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Models\Query::where('name', 'like', 'gmf.sys.%.list')->delete();
	}
}
