<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CboQuerySeeder extends Seeder {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {
		$this->down();

		$exception = DB::transaction(function () {
			$id = "a84fbb20107f11e7941defd9424c1f54";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.org.list')->entity('suite.cbo.org')
					->fields(['id', 'code', 'name', 'manager.name', 'short_name']);
				$builder->orders(['code' => 'asc', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});
			$id = "a84fbd10107f11e794d0f977720ae90b";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.dept.list')->entity('suite.cbo.dept')
					->fields(['id', 'code', 'name', 'manager.name', 'org.name', 'type_enum']);
				$builder->orders(['org.code' => 'asc', 'code' => 'asc', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a84fbda0107f11e7b5c163c1cce808d9";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.work.list')->entity('suite.cbo.work')
					->fields(['id', 'code', 'name', 'manager.name', 'org.name', 'dept.name']);
				$builder->orders(['org.code' => 'asc', 'dept.code' => 'asc', 'code' => 'asc', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "a84fbdf0107f11e7a26421a08bab0d27";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.team.list')->entity('suite.cbo.team')
					->fields(['id', 'code', 'name', 'manager.name', 'org.name', 'dept.name', 'work.name']);
				$builder->orders(['org.code' => 'asc', 'dept.code' => 'asc', 'work.code' => 'asc', 'code' => 'asc', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});
		});

		$exception = DB::transaction(function () {
			$id = "49ed162010c411e7aab067b14b675389";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.area.list')->entity('suite.cbo.area')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->orders(['code' => 'asc', 'created_at' => 'desc']);
				$builder->filter('a0.ent_id=#{entId}#');
			});
			$id = "49ed18b010c411e7802ad5c33a0e07ec";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.country.list')->entity('suite.cbo.country')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
			});

			$id = "49ed198010c411e7aa78379df58b2a94";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.currency.list')->entity('suite.cbo.currency')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "7420e5604e6b11e7a6203b0a37b5d644";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.province.list')->entity('suite.cbo.province')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "49ed1a1010c411e7a427658291639a26";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.division.list')->entity('suite.cbo.division')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "49ed1a9010c411e786b2094bba03baef";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.item.list')->entity('suite.cbo.item')
					->fields(['id', 'code' => '编码', 'name' => '名称']);

				$builder->matchs('code;name');
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "49ed1b2010c411e7a45ae91875996f88";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.item.category.list')->entity('suite.cbo.item.category')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "49ed1ba010c411e792d5d340836a0ef3";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.lot.list')->entity('suite.cbo.lot')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "49ed1c1010c411e789b0276b81a5ee05";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.mfc.list')->entity('suite.cbo.mfc')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "49ed1c9010c411e79723a9015d76d46a";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.mfc.category.list')->entity('suite.cbo.mfc.category')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "49ed1d1010c411e7ad0fa5ef48262bdb";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.period.account.list')->entity('suite.cbo.period.account')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e5eb155010c411e78f31139c8eec59e9";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.period.calendar.list')->entity('suite.cbo.period.calendar')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e5eb17f010c411e788b469f07ebcd3da";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.person.list')->entity('suite.cbo.person')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e5eb185010c411e7a75a6113dbb6761b";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.project.list')->entity('suite.cbo.project')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e5eb1ae010c411e7adc4b375ce650618";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.project.category.list')->entity('suite.cbo.project.category')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e5eb1b5010c411e7bc2ce10b121394e3";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.trader.list')->entity('suite.cbo.trader')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e5eb1bb010c411e7bec1ddfe005e056a";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.trader.category.list')->entity('suite.cbo.trader.category')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e5eb1c0010c411e7960a0d21a655b54a";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.unit.list')->entity('suite.cbo.unit')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e5eb1cc010c411e7b6044f8e5c07aaba";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.wh.list')->entity('suite.cbo.wh')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "f763aa10482611e7a3de211f4b3f829d";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.resource.list')->entity('suite.cbo.resource')
					->fields(['id', 'code' => '编码', 'name' => '名称']);
				$builder->filter('a0.ent_id=#{entId}#');
			});

			$id = "e1a9edc0483811e7861e3d18a403c8e5";
			Models\Query::build(function (Builder $builder) use ($id) {
				$builder->id($id)->name('suite.cbo.doc.type.list')->entity('suite.cbo.doc.type');
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
		Models\Query::where('name', 'like', 'suite.cbo.%.list')->delete();
	}
}
