<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboTraderSeeder extends Seeder {
	public $entId = '';

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if (empty($this->entId)) {
			$this->entId = config('gmf.ent.id');
		}
		if (empty($this->entId)) {
			return;
		}
		if (Models\Trader::where('ent_id', $this->entId)->count()) {
			return;
		}
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("800")->name("800集团公司")->short_name("")->category("")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("810")->name("810生产公司")->short_name("")->category("")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("820")->name("820新品公司")->short_name("")->category("")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("830")->name("830销售公司")->short_name("")->category("")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("V001")->name("上海宝山钢铁贸易有限公司")->short_name("上宝")->category("L01")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("V002")->name("天津木材加工厂")->short_name("天木")->category("L02")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("V004")->name("风帆新材料股份有限公司")->short_name("风帆")->category("L02")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("C001")->name("北京通途商贸有限公司")->short_name("北京通途")->category("D01")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("C002")->name("上海畅达商贸有限公司")->short_name("上海畅达")->category("D99")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("C003")->name("保定锂捷商贸有限公司")->short_name("保定锂捷")->category("D99")->area("");});
		Models\Trader::build(function (Builder $b) {$b->ent_id($this->entId)->code("C005")->name("天津铸件加工厂")->short_name("天津铸件")->category("D99")->area("");});

	}
}
