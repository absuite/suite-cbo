<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboProvinceSeeder extends Seeder {
	private $entId = '';

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->entId = config('gmf.ent.id');

		Models\Province::where('ent_id', $this->entId)->delete();

		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("11")->name("北京市")->short_name("北京")->area("HB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("12")->name("天津市")->short_name("天津")->area("HB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("13")->name("河北省")->short_name("河北")->area("HB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("14")->name("山西省")->short_name("山西")->area("HB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("15")->name("内蒙古自治区")->short_name("内蒙")->area("HB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("21")->name("辽宁省")->short_name("辽宁")->area("DB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("22")->name("吉林省")->short_name("吉林")->area("DB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("23")->name("黑龙江省")->short_name("黑龙江")->area("DB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("31")->name("上海市")->short_name("上海")->area("HD")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("32")->name("江苏省")->short_name("江苏")->area("HD")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("33")->name("浙江省")->short_name("浙江")->area("HD")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("34")->name("安徽省")->short_name("安徽")->area("HD")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("35")->name("福建省")->short_name("福建")->area("HD")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("36")->name("江西省")->short_name("江西")->area("HD")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("37")->name("山东省")->short_name("山东")->area("HD")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("41")->name("河南省")->short_name("河南")->area("HZ")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("42")->name("湖北省")->short_name("湖北")->area("HZ")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("43")->name("湖南省")->short_name("湖南")->area("HZ")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("44")->name("广东省")->short_name("广东")->area("HN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("45")->name("广西壮族自治区")->short_name("广西")->area("HN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("46")->name("海南省")->short_name("海南")->area("HN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("50")->name("重庆市")->short_name("重庆")->area("XN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("51")->name("")->short_name("四川")->area("XN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("52")->name("贵州省")->short_name("贵州")->area("XN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("53")->name("云南省")->short_name("云南")->area("XN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("54")->name("西藏自治区")->short_name("西藏")->area("XN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("61")->name("陕西省")->short_name("陕西")->area("XB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("62")->name("甘肃省")->short_name("甘肃")->area("XB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("63")->name("")->short_name("青海")->area("XB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("64")->name("宁夏回族自治区")->short_name("宁夏")->area("XB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("65")->name("新疆维吾尔自治区")->short_name("新疆")->area("XB")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("71")->name("台湾省")->short_name("台湾")->area("HD")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("81")->name("香港特别行政区")->short_name("香港")->area("HN")->country("CHN");});
		Models\Province::build(function (Builder $b) {$b->ent_id($this->entId)->code("82")->name("澳门特别行政区")->short_name("澳门")->area("HN")->country("CHN");});

	}
}
