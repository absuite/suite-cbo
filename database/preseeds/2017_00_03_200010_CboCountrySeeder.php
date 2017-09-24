<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Cbo\Models;

class CboCountrySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		Models\Country::where('id', '!=', '')->delete();

		Models\Country::build(function (Builder $b) {$b->code("ABW")->name("阿鲁巴")->short_name("阿鲁巴");});
		Models\Country::build(function (Builder $b) {$b->code("AFG")->name("阿富汗 ")->short_name("阿富汗 ");});
		Models\Country::build(function (Builder $b) {$b->code("AGO")->name("安哥拉")->short_name("安哥拉");});
		Models\Country::build(function (Builder $b) {$b->code("AIA")->name("安圭拉 ")->short_name("安圭拉 ");});
		Models\Country::build(function (Builder $b) {$b->code("ALB")->name("阿尔巴尼亚")->short_name("阿尔巴尼亚");});
		Models\Country::build(function (Builder $b) {$b->code("AND")->name("安道尔")->short_name("安道尔");});
		Models\Country::build(function (Builder $b) {$b->code("ANT")->name("荷属安的列斯")->short_name("荷属安的列斯");});
		Models\Country::build(function (Builder $b) {$b->code("ARE")->name("阿联酋 ")->short_name("阿联酋 ");});
		Models\Country::build(function (Builder $b) {$b->code("ARG")->name("阿根廷")->short_name("阿根廷");});
		Models\Country::build(function (Builder $b) {$b->code("ARM")->name("亚美尼亚")->short_name("亚美尼亚");});
		Models\Country::build(function (Builder $b) {$b->code("ASM")->name("美属萨摩亚")->short_name("美属萨摩亚");});
		Models\Country::build(function (Builder $b) {$b->code("ATF")->name("法属南部领土 ")->short_name("法属南部领土 ");});
		Models\Country::build(function (Builder $b) {$b->code("ATG")->name("安提瓜和巴布达")->short_name("安提瓜和巴布达");});
		Models\Country::build(function (Builder $b) {$b->code("AUS")->name("澳大利亚")->short_name("澳大利亚");});
		Models\Country::build(function (Builder $b) {$b->code("AUT")->name("奥地利")->short_name("奥地利");});
		Models\Country::build(function (Builder $b) {$b->code("AZE")->name("阿塞拜疆")->short_name("阿塞拜疆");});
		Models\Country::build(function (Builder $b) {$b->code("BDI")->name("布隆迪")->short_name("布隆迪");});
		Models\Country::build(function (Builder $b) {$b->code("BEL")->name("比利时")->short_name("比利时");});
		Models\Country::build(function (Builder $b) {$b->code("BEN")->name("贝宁")->short_name("贝宁");});
		Models\Country::build(function (Builder $b) {$b->code("BFA")->name("布基纳法索 ")->short_name("布基纳法索 ");});
		Models\Country::build(function (Builder $b) {$b->code("BGD")->name("孟加拉国")->short_name("孟加拉国");});
		Models\Country::build(function (Builder $b) {$b->code("BGR")->name("保加利亚")->short_name("保加利亚");});
		Models\Country::build(function (Builder $b) {$b->code("BHR")->name("")->short_name("巴林");});
		Models\Country::build(function (Builder $b) {$b->code("BHS")->name("巴哈马")->short_name("巴哈马");});
		Models\Country::build(function (Builder $b) {$b->code("BIH")->name("波斯尼亚和黑塞哥维那")->short_name("波斯尼亚和黑塞哥维那");});
		Models\Country::build(function (Builder $b) {$b->code("BLR")->name("白俄罗斯")->short_name("白俄罗斯");});
		Models\Country::build(function (Builder $b) {$b->code("BLZ")->name("伯利兹")->short_name("伯利兹");});
		Models\Country::build(function (Builder $b) {$b->code("BMU")->name("百慕大")->short_name("百慕大");});
		Models\Country::build(function (Builder $b) {$b->code("BOL")->name("")->short_name("玻利维亚");});
		Models\Country::build(function (Builder $b) {$b->code("BRA")->name("巴西")->short_name("巴西");});
		Models\Country::build(function (Builder $b) {$b->code("BRB")->name("巴巴多斯")->short_name("巴巴多斯");});
		Models\Country::build(function (Builder $b) {$b->code("BRN")->name("文莱")->short_name("文莱");});
		Models\Country::build(function (Builder $b) {$b->code("BTN")->name("不丹")->short_name("不丹");});
		Models\Country::build(function (Builder $b) {$b->code("BWA")->name("博茨瓦纳")->short_name("博茨瓦纳");});
		Models\Country::build(function (Builder $b) {$b->code("CAF")->name("中非")->short_name("中非");});
		Models\Country::build(function (Builder $b) {$b->code("CAN")->name("加拿大")->short_name("加拿大");});
		Models\Country::build(function (Builder $b) {$b->code("CCK")->name("科科斯(基林)群岛")->short_name("科科斯(基林)群岛");});
		Models\Country::build(function (Builder $b) {$b->code("CHE")->name("瑞士 ")->short_name("瑞士 ");});
		Models\Country::build(function (Builder $b) {$b->code("CHL")->name("智利 ")->short_name("智利 ");});
		Models\Country::build(function (Builder $b) {$b->code("CHN")->name("中华人民共和国")->short_name("中国 ");});
		Models\Country::build(function (Builder $b) {$b->code("CIV")->name("科特迪瓦")->short_name("科特迪瓦");});
		Models\Country::build(function (Builder $b) {$b->code("CMR")->name("喀麦隆")->short_name("喀麦隆");});
		Models\Country::build(function (Builder $b) {$b->code("COG")->name("刚果 ")->short_name("刚果 ");});
		Models\Country::build(function (Builder $b) {$b->code("COK")->name("库克群岛")->short_name("库克群岛");});
		Models\Country::build(function (Builder $b) {$b->code("COL")->name("哥伦比亚")->short_name("哥伦比亚");});
		Models\Country::build(function (Builder $b) {$b->code("COM")->name("科摩罗")->short_name("科摩罗");});
		Models\Country::build(function (Builder $b) {$b->code("CPV")->name("佛得角")->short_name("佛得角");});
		Models\Country::build(function (Builder $b) {$b->code("CUB")->name("古巴")->short_name("古巴");});
		Models\Country::build(function (Builder $b) {$b->code("CYM")->name("开曼群岛 ")->short_name("开曼群岛 ");});
		Models\Country::build(function (Builder $b) {$b->code("CYP")->name("塞浦路斯")->short_name("塞浦路斯");});
		Models\Country::build(function (Builder $b) {$b->code("CZE")->name("捷克")->short_name("捷克");});
		Models\Country::build(function (Builder $b) {$b->code("DEU")->name("德意志联邦共和国")->short_name("德国");});
		Models\Country::build(function (Builder $b) {$b->code("DJI")->name("吉布提 ")->short_name("吉布提 ");});
		Models\Country::build(function (Builder $b) {$b->code("DMA")->name("多米尼克 ")->short_name("多米尼克 ");});
		Models\Country::build(function (Builder $b) {$b->code("DNK")->name("丹麦")->short_name("丹麦");});
		Models\Country::build(function (Builder $b) {$b->code("DOM")->name("多米尼加")->short_name("多米尼加");});
		Models\Country::build(function (Builder $b) {$b->code("DZA")->name("阿尔及利亚")->short_name("阿尔及利亚");});
		Models\Country::build(function (Builder $b) {$b->code("ECU")->name("厄瓜多尔")->short_name("厄瓜多尔");});
		Models\Country::build(function (Builder $b) {$b->code("EGY")->name("埃及")->short_name("埃及");});
		Models\Country::build(function (Builder $b) {$b->code("ERI")->name("厄立特里亚")->short_name("厄立特里亚");});
		Models\Country::build(function (Builder $b) {$b->code("ESH")->name("西撒哈拉")->short_name("西撒哈拉");});
		Models\Country::build(function (Builder $b) {$b->code("ESP")->name("西班牙王国")->short_name("西班牙");});
		Models\Country::build(function (Builder $b) {$b->code("EST")->name("爱沙尼亚")->short_name("爱沙尼亚");});
		Models\Country::build(function (Builder $b) {$b->code("ETH")->name("埃塞俄比亚")->short_name("埃塞俄比亚");});
		Models\Country::build(function (Builder $b) {$b->code("FIN")->name("芬兰 ")->short_name("芬兰 ");});
		Models\Country::build(function (Builder $b) {$b->code("FJI")->name("斐济 ")->short_name("斐济 ");});
		Models\Country::build(function (Builder $b) {$b->code("FLK")->name("马尔维纳斯群岛(福克兰群岛)")->short_name("马尔维纳斯群岛(福克兰群岛)");});
		Models\Country::build(function (Builder $b) {$b->code("FRA")->name("法兰西第五共和国 ")->short_name("法国");});
		Models\Country::build(function (Builder $b) {$b->code("FRO")->name("法罗群岛 ")->short_name("法罗群岛 ");});
		Models\Country::build(function (Builder $b) {$b->code("FSM")->name("密克罗尼西亚")->short_name("密克罗尼西亚");});
		Models\Country::build(function (Builder $b) {$b->code("GAB")->name("加蓬 ")->short_name("加蓬 ");});
		Models\Country::build(function (Builder $b) {$b->code("GBR")->name("大不列颠及北爱尔兰联合王国 ")->short_name("英国 ");});
		Models\Country::build(function (Builder $b) {$b->code("GEO")->name("格鲁吉亚 ")->short_name("格鲁吉亚 ");});
		Models\Country::build(function (Builder $b) {$b->code("GHA")->name("加纳 ")->short_name("加纳 ");});
		Models\Country::build(function (Builder $b) {$b->code("GIB")->name("直布罗陀")->short_name("直布罗陀");});
		Models\Country::build(function (Builder $b) {$b->code("GIN")->name("几内亚")->short_name("几内亚");});
		Models\Country::build(function (Builder $b) {$b->code("GLP")->name("瓜德罗普")->short_name("瓜德罗普");});
		Models\Country::build(function (Builder $b) {$b->code("GMB")->name("冈比亚")->short_name("冈比亚");});
		Models\Country::build(function (Builder $b) {$b->code("GNB")->name("几内亚比绍 ")->short_name("几内亚比绍 ");});
		Models\Country::build(function (Builder $b) {$b->code("GNQ")->name("赤道几内亚")->short_name("赤道几内亚");});
		Models\Country::build(function (Builder $b) {$b->code("GRC")->name("希腊 ")->short_name("希腊 ");});
		Models\Country::build(function (Builder $b) {$b->code("GRD")->name("格林纳达 ")->short_name("格林纳达 ");});
		Models\Country::build(function (Builder $b) {$b->code("GRL")->name("格陵兰 ")->short_name("格陵兰 ");});
		Models\Country::build(function (Builder $b) {$b->code("GTM")->name("危地马拉 ")->short_name("危地马拉 ");});
		Models\Country::build(function (Builder $b) {$b->code("GUF")->name("法属圭亚那")->short_name("法属圭亚那");});
		Models\Country::build(function (Builder $b) {$b->code("GUM")->name("关岛 Guam")->short_name("关岛 Guam");});
		Models\Country::build(function (Builder $b) {$b->code("GUY")->name("圭亚那")->short_name("圭亚那");});
		Models\Country::build(function (Builder $b) {$b->code("HKG")->name("中国香港")->short_name("中国香港");});
		Models\Country::build(function (Builder $b) {$b->code("HMD")->name("赫德岛和麦克唐纳岛")->short_name("赫德岛和麦克唐纳岛");});
		Models\Country::build(function (Builder $b) {$b->code("HND")->name("洪都拉斯 ")->short_name("洪都拉斯 ");});
		Models\Country::build(function (Builder $b) {$b->code("HRV")->name("克罗地亚")->short_name("克罗地亚");});
		Models\Country::build(function (Builder $b) {$b->code("HTI")->name("海地")->short_name("海地");});
		Models\Country::build(function (Builder $b) {$b->code("HUN")->name("匈牙利")->short_name("匈牙利");});
		Models\Country::build(function (Builder $b) {$b->code("IDN")->name("印度尼西亚")->short_name("印度尼西亚");});
		Models\Country::build(function (Builder $b) {$b->code("IND")->name("印度共和国")->short_name("印度 ");});
		Models\Country::build(function (Builder $b) {$b->code("IOT")->name("英属印度洋领土 ")->short_name("英属印度洋领土 ");});
		Models\Country::build(function (Builder $b) {$b->code("IRL")->name("爱尔兰")->short_name("爱尔兰");});
		Models\Country::build(function (Builder $b) {$b->code("IRN")->name("伊朗")->short_name("伊朗");});
		Models\Country::build(function (Builder $b) {$b->code("IRQ")->name("伊拉克")->short_name("伊拉克");});
		Models\Country::build(function (Builder $b) {$b->code("ISL")->name("冰岛")->short_name("冰岛");});
		Models\Country::build(function (Builder $b) {$b->code("ISR")->name("以色列")->short_name("以色列");});
		Models\Country::build(function (Builder $b) {$b->code("ITA")->name("意大利共和国")->short_name("意大利");});
		Models\Country::build(function (Builder $b) {$b->code("JAM")->name("牙买加 ")->short_name("牙买加 ");});
		Models\Country::build(function (Builder $b) {$b->code("JOR")->name("约旦")->short_name("约旦");});
		Models\Country::build(function (Builder $b) {$b->code("JPN")->name("日本国")->short_name("日本");});
		Models\Country::build(function (Builder $b) {$b->code("KAZ")->name("哈萨克斯坦")->short_name("哈萨克斯坦");});
		Models\Country::build(function (Builder $b) {$b->code("KEN")->name("肯尼亚")->short_name("肯尼亚");});
		Models\Country::build(function (Builder $b) {$b->code("KGZ")->name("吉尔吉斯斯坦")->short_name("吉尔吉斯斯坦");});
		Models\Country::build(function (Builder $b) {$b->code("KHM")->name("柬埔寨")->short_name("柬埔寨");});
		Models\Country::build(function (Builder $b) {$b->code("KIR")->name("基里巴斯")->short_name("基里巴斯");});
		Models\Country::build(function (Builder $b) {$b->code("KNA")->name("圣基茨和尼维斯")->short_name("圣基茨和尼维斯");});
		Models\Country::build(function (Builder $b) {$b->code("KOR")->name("大韩民国")->short_name("韩国");});
		Models\Country::build(function (Builder $b) {$b->code("KWT")->name("科威特")->short_name("科威特");});
		Models\Country::build(function (Builder $b) {$b->code("LAO")->name("老挝")->short_name("老挝");});
		Models\Country::build(function (Builder $b) {$b->code("LBN")->name("黎巴嫩")->short_name("黎巴嫩");});
		Models\Country::build(function (Builder $b) {$b->code("LBR")->name("利比里亚")->short_name("利比里亚");});
		Models\Country::build(function (Builder $b) {$b->code("LBY")->name("利比亚")->short_name("利比亚");});
		Models\Country::build(function (Builder $b) {$b->code("LCA")->name("圣卢西亚")->short_name("圣卢西亚");});
		Models\Country::build(function (Builder $b) {$b->code("LKA")->name("斯里兰卡")->short_name("斯里兰卡");});
		Models\Country::build(function (Builder $b) {$b->code("LSO")->name("莱索托")->short_name("莱索托");});
		Models\Country::build(function (Builder $b) {$b->code("LTU")->name("立陶宛")->short_name("立陶宛");});
		Models\Country::build(function (Builder $b) {$b->code("LUX")->name("卢森堡 ")->short_name("卢森堡 ");});
		Models\Country::build(function (Builder $b) {$b->code("LVA")->name("拉脱维亚 ")->short_name("拉脱维亚 ");});
		Models\Country::build(function (Builder $b) {$b->code("MAC")->name("中国澳门 ")->short_name("中国澳门 ");});
		Models\Country::build(function (Builder $b) {$b->code("MAR")->name("摩洛哥 ")->short_name("摩洛哥 ");});
		Models\Country::build(function (Builder $b) {$b->code("MDA")->name("摩尔多瓦")->short_name("摩尔多瓦");});
		Models\Country::build(function (Builder $b) {$b->code("MDG")->name("马达加斯加 ")->short_name("马达加斯加 ");});
		Models\Country::build(function (Builder $b) {$b->code("MDV")->name("马尔代夫 ")->short_name("马尔代夫 ");});
		Models\Country::build(function (Builder $b) {$b->code("MEX")->name("墨西哥 ")->short_name("墨西哥 ");});
		Models\Country::build(function (Builder $b) {$b->code("MHL")->name("马绍尔群岛")->short_name("马绍尔群岛");});
		Models\Country::build(function (Builder $b) {$b->code("MKD")->name("马斯顿")->short_name("马斯顿");});
		Models\Country::build(function (Builder $b) {$b->code("MLI")->name("马里")->short_name("马里");});
		Models\Country::build(function (Builder $b) {$b->code("MLT")->name("马耳他 ")->short_name("马耳他 ");});
		Models\Country::build(function (Builder $b) {$b->code("MMR")->name("缅甸")->short_name("缅甸");});
		Models\Country::build(function (Builder $b) {$b->code("MNG")->name("蒙古")->short_name("蒙古");});
		Models\Country::build(function (Builder $b) {$b->code("MNP")->name("北马里亚纳")->short_name("北马里亚纳");});
		Models\Country::build(function (Builder $b) {$b->code("MOZ")->name("莫桑比克 ")->short_name("莫桑比克 ");});
		Models\Country::build(function (Builder $b) {$b->code("MRT")->name("毛里塔尼亚")->short_name("毛里塔尼亚");});
		Models\Country::build(function (Builder $b) {$b->code("MSR")->name("蒙特塞拉特 ")->short_name("蒙特塞拉特 ");});
		Models\Country::build(function (Builder $b) {$b->code("MTQ")->name("马提尼克 ")->short_name("马提尼克 ");});
		Models\Country::build(function (Builder $b) {$b->code("MUS")->name("毛里求斯")->short_name("毛里求斯");});
		Models\Country::build(function (Builder $b) {$b->code("MWI")->name("马拉维 ")->short_name("马拉维 ");});
		Models\Country::build(function (Builder $b) {$b->code("MYS")->name("马来西亚 ")->short_name("马来西亚 ");});
		Models\Country::build(function (Builder $b) {$b->code("MYT")->name("马约特 ")->short_name("马约特 ");});
		Models\Country::build(function (Builder $b) {$b->code("NAM")->name("纳米比亚")->short_name("纳米比亚");});
		Models\Country::build(function (Builder $b) {$b->code("NCL")->name("新喀里多尼亚")->short_name("新喀里多尼亚");});
		Models\Country::build(function (Builder $b) {$b->code("NER")->name("尼日尔")->short_name("尼日尔");});
		Models\Country::build(function (Builder $b) {$b->code("NFK")->name("诺福克岛")->short_name("诺福克岛");});
		Models\Country::build(function (Builder $b) {$b->code("NGA")->name("尼日利亚")->short_name("尼日利亚");});
		Models\Country::build(function (Builder $b) {$b->code("NIC")->name("尼加拉瓜")->short_name("尼加拉瓜");});
		Models\Country::build(function (Builder $b) {$b->code("NIU")->name("纽埃 Niue")->short_name("纽埃 Niue");});
		Models\Country::build(function (Builder $b) {$b->code("NLD")->name("荷兰 ")->short_name("荷兰 ");});
		Models\Country::build(function (Builder $b) {$b->code("NOR")->name("挪威")->short_name("挪威");});
		Models\Country::build(function (Builder $b) {$b->code("NPL")->name("尼泊尔")->short_name("尼泊尔");});
		Models\Country::build(function (Builder $b) {$b->code("NRU")->name("瑙鲁")->short_name("瑙鲁");});
		Models\Country::build(function (Builder $b) {$b->code("NZL")->name("新西兰")->short_name("新西兰");});
		Models\Country::build(function (Builder $b) {$b->code("OMN")->name("阿曼")->short_name("阿曼");});
		Models\Country::build(function (Builder $b) {$b->code("PAK")->name("巴基斯坦 ")->short_name("巴基斯坦 ");});
		Models\Country::build(function (Builder $b) {$b->code("PAN")->name("巴拿马 ")->short_name("巴拿马 ");});
		Models\Country::build(function (Builder $b) {$b->code("PCN")->name("皮特凯恩群岛")->short_name("皮特凯恩群岛");});
		Models\Country::build(function (Builder $b) {$b->code("PER")->name("秘鲁")->short_name("秘鲁");});
		Models\Country::build(function (Builder $b) {$b->code("PHL")->name("菲律宾")->short_name("菲律宾");});
		Models\Country::build(function (Builder $b) {$b->code("PLW")->name("贝劳 ")->short_name("贝劳 ");});
		Models\Country::build(function (Builder $b) {$b->code("PNG")->name("巴布亚新几内亚 ")->short_name("巴布亚新几内亚 ");});
		Models\Country::build(function (Builder $b) {$b->code("POL")->name("波兰")->short_name("波兰");});
		Models\Country::build(function (Builder $b) {$b->code("PRK")->name("朝鲜")->short_name("朝鲜");});
		Models\Country::build(function (Builder $b) {$b->code("PRT")->name("葡萄牙")->short_name("葡萄牙");});
		Models\Country::build(function (Builder $b) {$b->code("PRY")->name("巴拉圭")->short_name("巴拉圭");});
		Models\Country::build(function (Builder $b) {$b->code("PYF")->name("法属波利尼西亚")->short_name("法属波利尼西亚");});
		Models\Country::build(function (Builder $b) {$b->code("QAT")->name("卡塔尔 ")->short_name("卡塔尔 ");});
		Models\Country::build(function (Builder $b) {$b->code("REU")->name("留尼汪")->short_name("留尼汪");});
		Models\Country::build(function (Builder $b) {$b->code("RUS")->name("俄罗斯联邦")->short_name("俄罗斯");});
		Models\Country::build(function (Builder $b) {$b->code("RWA")->name("卢旺达")->short_name("卢旺达");});
		Models\Country::build(function (Builder $b) {$b->code("SAU")->name("沙竺阿拉伯 ")->short_name("沙竺阿拉伯 ");});
		Models\Country::build(function (Builder $b) {$b->code("SDN")->name("苏丹 ")->short_name("苏丹 ");});
		Models\Country::build(function (Builder $b) {$b->code("SEN")->name("塞内加尔")->short_name("塞内加尔");});
		Models\Country::build(function (Builder $b) {$b->code("SGP")->name("新加坡共和国")->short_name("新加坡 ");});
		Models\Country::build(function (Builder $b) {$b->code("SGS")->name("南乔治亚岛和南桑德韦奇岛")->short_name("南乔治亚岛和南桑德韦奇岛");});
		Models\Country::build(function (Builder $b) {$b->code("SHN")->name("圣赫勒拿 ")->short_name("圣赫勒拿 ");});
		Models\Country::build(function (Builder $b) {$b->code("SLB")->name("所罗门群岛 ")->short_name("所罗门群岛 ");});
		Models\Country::build(function (Builder $b) {$b->code("SLE")->name("塞拉利昂 ")->short_name("塞拉利昂 ");});
		Models\Country::build(function (Builder $b) {$b->code("SLV")->name("萨尔瓦多")->short_name("萨尔瓦多");});
		Models\Country::build(function (Builder $b) {$b->code("SMR")->name("圣马力诺")->short_name("圣马力诺");});
		Models\Country::build(function (Builder $b) {$b->code("SOM")->name("索马里")->short_name("索马里");});
		Models\Country::build(function (Builder $b) {$b->code("SPM")->name("圣皮埃尔和密克隆 ")->short_name("圣皮埃尔和密克隆 ");});
		Models\Country::build(function (Builder $b) {$b->code("SUR")->name("苏里南 ")->short_name("苏里南 ");});
		Models\Country::build(function (Builder $b) {$b->code("SVK")->name("斯洛伐克 ")->short_name("斯洛伐克 ");});
		Models\Country::build(function (Builder $b) {$b->code("SVN")->name("斯洛文尼亚")->short_name("斯洛文尼亚");});
		Models\Country::build(function (Builder $b) {$b->code("SWE")->name("瑞典 ")->short_name("瑞典 ");});
		Models\Country::build(function (Builder $b) {$b->code("SWZ")->name("斯威士兰 ")->short_name("斯威士兰 ");});
		Models\Country::build(function (Builder $b) {$b->code("SYC")->name("塞舌尔")->short_name("塞舌尔");});
		Models\Country::build(function (Builder $b) {$b->code("SYR")->name("叙利亚 Syria")->short_name("叙利亚 Syria");});
		Models\Country::build(function (Builder $b) {$b->code("TCA")->name("特克斯科斯群岛")->short_name("特克斯科斯群岛");});
		Models\Country::build(function (Builder $b) {$b->code("TCD")->name("乍得 ")->short_name("乍得 ");});
		Models\Country::build(function (Builder $b) {$b->code("TGO")->name("多哥 ")->short_name("多哥 ");});
		Models\Country::build(function (Builder $b) {$b->code("THA")->name("泰国 ")->short_name("泰国 ");});
		Models\Country::build(function (Builder $b) {$b->code("TJK")->name("塔吉克斯坦 ")->short_name("塔吉克斯坦 ");});
		Models\Country::build(function (Builder $b) {$b->code("TKL")->name("托克劳 Tokelau")->short_name("托克劳 Tokelau");});
		Models\Country::build(function (Builder $b) {$b->code("TKM")->name("土库曼斯坦")->short_name("土库曼斯坦");});
		Models\Country::build(function (Builder $b) {$b->code("TON")->name("汤加 ")->short_name("汤加 ");});
		Models\Country::build(function (Builder $b) {$b->code("TTO")->name("特立尼达和多巴哥 ")->short_name("特立尼达和多巴哥 ");});
		Models\Country::build(function (Builder $b) {$b->code("TUN")->name("突尼斯")->short_name("突尼斯");});
		Models\Country::build(function (Builder $b) {$b->code("TUR")->name("土耳其 ")->short_name("土耳其 ");});
		Models\Country::build(function (Builder $b) {$b->code("TUV")->name("图瓦卢 ")->short_name("图瓦卢 ");});
		Models\Country::build(function (Builder $b) {$b->code("TZA")->name("坦桑尼亚")->short_name("坦桑尼亚");});
		Models\Country::build(function (Builder $b) {$b->code("UGA")->name("乌干达 ")->short_name("乌干达 ");});
		Models\Country::build(function (Builder $b) {$b->code("UKR")->name("乌克兰 ")->short_name("乌克兰 ");});
		Models\Country::build(function (Builder $b) {$b->code("UMI")->name("美属太平洋各群岛(包括:中途岛、")->short_name("美属太平洋各群岛(包括:中途岛、");});
		Models\Country::build(function (Builder $b) {$b->code("URY")->name("乌拉圭 ")->short_name("乌拉圭 ");});
		Models\Country::build(function (Builder $b) {$b->code("USA")->name("美利坚合众国")->short_name("美国 ");});
		Models\Country::build(function (Builder $b) {$b->code("UZB")->name("乌兹别克斯坦")->short_name("乌兹别克斯坦");});
		Models\Country::build(function (Builder $b) {$b->code("VAT")->name("梵蒂冈")->short_name("梵蒂冈");});
		Models\Country::build(function (Builder $b) {$b->code("VCT")->name("圣文森特和格林纳丁斯")->short_name("圣文森特和格林纳丁斯");});
		Models\Country::build(function (Builder $b) {$b->code("VEN")->name("委内瑞拉 ")->short_name("委内瑞拉 ");});
		Models\Country::build(function (Builder $b) {$b->code("VGB")->name("英属维尔京群岛 ")->short_name("英属维尔京群岛 ");});
		Models\Country::build(function (Builder $b) {$b->code("VIR")->name("美属维尔京群岛 ")->short_name("美属维尔京群岛 ");});
		Models\Country::build(function (Builder $b) {$b->code("VNM")->name("越南 ")->short_name("越南 ");});
		Models\Country::build(function (Builder $b) {$b->code("VNM")->name("越南 ")->short_name("越南 ");});
		Models\Country::build(function (Builder $b) {$b->code("VUT")->name("瓦努阿图")->short_name("瓦努阿图");});
		Models\Country::build(function (Builder $b) {$b->code("WLF")->name("瓦利斯和富图纳群岛")->short_name("瓦利斯和富图纳群岛");});
		Models\Country::build(function (Builder $b) {$b->code("WSM")->name("西萨摩亚 ")->short_name("西萨摩亚 ");});
		Models\Country::build(function (Builder $b) {$b->code("YEM")->name("也门 ")->short_name("也门 ");});
		Models\Country::build(function (Builder $b) {$b->code("YUG")->name("南斯拉夫 ")->short_name("南斯拉夫 ");});
		Models\Country::build(function (Builder $b) {$b->code("ZAF")->name("南非 ")->short_name("南非 ");});
		Models\Country::build(function (Builder $b) {$b->code("ZMB")->name("赞比亚 ")->short_name("赞比亚 ");});
		Models\Country::build(function (Builder $b) {$b->code("ZWE")->name("津巴布韦 ")->short_name("津巴布韦 ");});

	}
}
