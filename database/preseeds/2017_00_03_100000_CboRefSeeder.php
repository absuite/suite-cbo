<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CboRefSeeder extends Seeder {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {

		$exception = DB::transaction(function () {
			$id = "220f0760108a11e7afcfcf76a541820f";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.org.ref')->entity('suite.cbo.org')->matchs('code;name')
					->fields(['id', 'code', 'name', 'manager.name', 'short_name']);
				$builder->orders(['code' => 'asc', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});
			$id = "220f09c0108a11e7a26d4f2eaa45bc8e";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.dept.ref')->entity('suite.cbo.dept')->matchs('code;name')
					->fields(['id', 'code', 'name', 'manager.name', 'org.name', 'type_enum']);
				$builder->orders(['org.code', 'code' => 'asc', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "220f0a80108a11e7a7d77ddc128cc28e";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.work.ref')->entity('suite.cbo.work')->matchs('code;name')
					->fields(['id', 'code', 'name', 'manager.name', 'org.name', 'dept.name']);
				$builder->orders(['org.code', 'dept.code', 'code' => 'asc', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "220f0b10108a11e79af6875051229d93";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.team.ref')->entity('suite.cbo.team')->matchs('code;name')
					->fields(['id', 'code', 'name', 'manager.name', 'org.name', 'dept.name', 'work.name']);
				$builder->filter('a0.ent_id=#{entId}#');
			});
		});

		$exception = DB::transaction(function () {
			$id = "83f7dac010c511e7baff739d7d7a427c";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.area.ref')->entity('suite.cbo.area')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});
			$id = "83f7dcb010c511e7a8806b26565c82ef";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.country.ref')->entity('suite.cbo.country')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
			});

			$id = "83f7dd4010c511e79a6f9727300bee17";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.currency.ref')->entity('suite.cbo.currency')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "827219404e6b11e781f3bbedee21a565";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.province.ref')->entity('suite.cbo.province')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "83f7dda010c511e78a621158d7a3609b";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.division.ref')->entity('suite.cbo.division')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "83f7de0010c511e7a5d707849e76036d";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.item.ref')->entity('suite.cbo.item')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "83f7de6010c511e7b7941320171dc191";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.item.category.ref')->entity('suite.cbo.item.category')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "83f7dea010c511e7b0281528d78d091c";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.lot.ref')->entity('suite.cbo.lot')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "83f7df0010c511e7841865d7b359cca5";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.mfc.ref')->entity('suite.cbo.mfc')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "83f7df6010c511e79a94438963cbff7f";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.mfc.category.ref')->entity('suite.cbo.mfc.category')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "83f7dfc010c511e789d2973826f91ccf";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.period.account.ref')->entity('suite.cbo.period.account')->matchs('year;month')
					->fields(['id', 'code' => '编码', 'name' => '名称', 'from_date', 'to_date', 'calendar.name']);
				$builder->orders(['calendar.code', 'code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a3596c8010c511e7806a81eb32dceda5";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.period.calendar.ref')->entity('suite.cbo.period.calendar')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a3596ea010c511e781ef417dd4dce90b";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.person.ref')->entity('suite.cbo.person')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a3596f3010c511e7806ca93c2a3e47d2";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.project.ref')->entity('suite.cbo.project')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a3596fa010c511e7977d1d4aa459d412";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.project.category.ref')->entity('suite.cbo.project.category')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a359700010c511e78386b9e9e2bfb069";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.trader.ref')->entity('suite.cbo.trader')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a359706010c511e7be2e19143af25fa0";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.trader.category.ref')->entity('suite.cbo.trader.category')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a35970b010c511e7b24ae7ef3763aa62";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.unit.ref')->entity('suite.cbo.unit')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a359711010c511e7b851538b8fcdd5d3";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.wh.ref')->entity('suite.cbo.wh')->matchs('code;name')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "ff3eb640483811e7ba1d398701d047da";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.resource.ref')->entity('suite.cbo.resource')->matchs('code;name');
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "ff3ebe00483811e78d91ab6df7b3dc8a";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.doc.type.ref')->entity('suite.cbo.doc.type')->matchs('code;name');
				$builder->fields(['id', 'biz_type_enum', 'code', 'name', 'is_effective']);
				$builder->orders(['biz_type_enum' => 'asc', 'code' => 'asc', 'created_at' => 'desc']);
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
		Models\Query::where('name', 'like', 'suite.cbo.%.ref')->delete();
	}
}
