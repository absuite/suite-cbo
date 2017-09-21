<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboDeptSeeder extends Seeder {
	private $entId = '';

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->entId = config('gmf.ent.id');

		Models\Dept::where('ent_id', $this->entId)->delete();

		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp80001")->name("集团公司财务部")->org("org800")->type_name("管理");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp80002")->name("集团公司研发部")->org("org800")->type_name("研发");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp80003")->name("集团公司采购部")->org("org800")->type_name("采购");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp80004")->name("集团公司仓储部")->org("org800")->type_name("仓储");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp81002")->name("生产公司生产部")->org("org810")->type_name("生产");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp81003")->name("生产公司仓储部")->org("org810")->type_name("仓储");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp81004")->name("生产公司质检部")->org("org810")->type_name("服务");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp81005")->name("生产公司机加工车间")->org("org810")->type_name("生产");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp81006")->name("生产公司热处理车间")->org("org810")->type_name("生产");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp82002")->name("新品公司装配车间")->org("org820")->type_name("生产");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp82003")->name("新品公司采购部")->org("org820")->type_name("采购");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp83001")->name("销售公司销售一部")->org("org830")->type_name("销售");});
		Models\Dept::build(function (Builder $b) {$b->ent_id($this->entId)->code("dp83002")->name("销售公司销售二部")->org("org830")->type_name("销售");});

	}
}
