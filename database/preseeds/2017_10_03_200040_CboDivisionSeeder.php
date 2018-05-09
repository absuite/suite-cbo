<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboDivisionSeeder extends Seeder {
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
		if (Models\Division::where('ent_id', $this->entId)->count()) {
			return;
		}
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("1101")->name("北京市")->short_name("北京")->country("CHN")->province("11")->area("HB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("1201")->name("天津市")->short_name("天津")->country("CHN")->province("12")->area("HB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("1301")->name("河北省")->short_name("河北")->country("CHN")->province("13")->area("HB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("1401")->name("山西省")->short_name("山西")->country("CHN")->province("14")->area("HB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("1501")->name("内蒙古自治区")->short_name("内蒙")->country("CHN")->province("15")->area("HB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("2101")->name("辽宁省")->short_name("辽宁")->country("CHN")->province("21")->area("DB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("2201")->name("吉林省")->short_name("吉林")->country("CHN")->province("22")->area("DB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("2301")->name("黑龙江省")->short_name("黑龙江")->country("CHN")->province("23")->area("DB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("3101")->name("上海市")->short_name("上海")->country("CHN")->province("31")->area("HD");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("3201")->name("江苏省")->short_name("江苏")->country("CHN")->province("32")->area("HD");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("3301")->name("浙江省")->short_name("浙江")->country("CHN")->province("33")->area("HD");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("3401")->name("安徽省")->short_name("安徽")->country("CHN")->province("34")->area("HD");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("3501")->name("福建省")->short_name("福建")->country("CHN")->province("35")->area("HD");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("3601")->name("江西省")->short_name("江西")->country("CHN")->province("36")->area("HD");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("3701")->name("山东省")->short_name("山东")->country("CHN")->province("37")->area("HD");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("4101")->name("河南省")->short_name("河南")->country("CHN")->province("41")->area("HZ");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("4201")->name("湖北省")->short_name("湖北")->country("CHN")->province("42")->area("HZ");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("4301")->name("湖南省")->short_name("湖南")->country("CHN")->province("43")->area("HZ");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("4401")->name("广东省")->short_name("广东")->country("CHN")->province("44")->area("HN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("4501")->name("广西壮族自治区")->short_name("广西")->country("CHN")->province("45")->area("HN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("4601")->name("海南省")->short_name("海南")->country("CHN")->province("46")->area("HN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("5001")->name("重庆市")->short_name("重庆")->country("CHN")->province("50")->area("XN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("5101")->name("")->short_name("四川")->country("CHN")->province("51")->area("XN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("5201")->name("贵州省")->short_name("贵州")->country("CHN")->province("52")->area("XN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("5301")->name("云南省")->short_name("云南")->country("CHN")->province("53")->area("XN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("5401")->name("西藏自治区")->short_name("西藏")->country("CHN")->province("54")->area("XN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("6101")->name("陕西省")->short_name("陕西")->country("CHN")->province("61")->area("XB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("6201")->name("甘肃省")->short_name("甘肃")->country("CHN")->province("62")->area("XB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("6301")->name("")->short_name("青海")->country("CHN")->province("63")->area("XB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("6401")->name("宁夏回族自治区")->short_name("宁夏")->country("CHN")->province("64")->area("XB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("6501")->name("新疆维吾尔自治区")->short_name("新疆")->country("CHN")->province("65")->area("XB");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("7101")->name("台湾省")->short_name("台湾")->country("CHN")->province("71")->area("HD");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("8101")->name("香港特别行政区")->short_name("香港")->country("CHN")->province("81")->area("HN");});
		Models\Division::build(function (Builder $b) {$b->ent_id($this->entId)->code("8201")->name("澳门特别行政区")->short_name("澳门")->country("CHN")->province("82")->area("HN");});

	}
}
