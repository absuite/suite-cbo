<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CboComponentSeeder extends Seeder {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {
		$this->down();
		$exception = DB::transaction(function () {
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Org.Edit')->name('组织')->path('cboOrgEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Org.List')->name('组织列表')->path('cboOrgList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Dept.Edit')->name('部门')->path('cboDeptEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Dept.List')->name('部门列表')->path('cboDeptList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Work.Edit')->name('工中中心')->path('cboWorkEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Work.List')->name('工中中心列表')->path('cboWorkList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Team.Edit')->name('班组')->path('cboTeamEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Team.List')->name('班组列表')->path('cboTeamList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Area.Edit')->name('区域')->path('cboAreaEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Area.List')->name('区域列表')->path('cboAreaList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Country.Edit')->name('国家')->path('cboCountryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Country.List')->name('国家列表')->path('cboCountryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Currency.Edit')->name('币种')->path('cboCurrencyEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Currency.List')->name('币种列表')->path('cboCurrencyList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Province.Edit')->name('城市区县')->path('cboProvinceEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Province.List')->name('城市区县列表')->path('cboProvinceList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Division.Edit')->name('区域')->path('cboDivisionEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Division.List')->name('区域列表')->path('cboDivisionList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Item.Edit')->name('物料')->path('cboItemEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Item.List')->name('物料列表')->path('cboItemList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Item.Category.Edit')->name('物料分类')->path('cboItemCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Item.Category.List')->name('物料分类列表')->path('cboItemCategoryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Lot.Edit')->name('批号')->path('cboLotEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Lot.List')->name('批号列表')->path('cboLotList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Mfc.Category.Edit')->name('厂牌分类')->path('cboMfcCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Mfc.Category.List')->name('厂牌分类列表')->path('cboMfcCategoryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Mfc.Edit')->name('厂牌')->path('cboMfcEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Mfc.List')->name('厂牌列表')->path('cboMfcList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Period.Account.List')->name('期间')->path('cboPeriodAccountList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Period.Calendar.Edit')->name('日历')->path('cboPeriodCalendarEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Period.Calendar.List')->name('日历列表')->path('cboPeriodCalendarList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Person.Edit')->name('人员')->path('cboPersonEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Person.List')->name('人员列表')->path('cboPersonList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Project.Category.Edit')->name('项目分类')->path('cboProjectCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Project.Category.List')->name('项目分类列表')->path('cboProjectCategoryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Project.Edit')->name('项目')->path('cboProjectEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Project.List')->name('项目列表')->path('cboProjectList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Trader.Category.Edit')->name('客商分类')->path('cboTraderCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Trader.Category.List')->name('客商分类列表')->path('cboTraderCategoryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Trader.Edit')->name('客商')->path('cboTraderEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Trader.List')->name('客商列表')->path('cboTraderList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Unit.Edit')->name('计量单位')->path('cboUnitEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Unit.List')->name('计量单位列表')->path('cboUnitList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Wh.Edit')->name('存储地点')->path('cboWhEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Wh.List')->name('存储地点列表')->path('cboWhList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Doc.Type.Edit')->name('单据类型')->path('cboDocTypeEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Doc.Type.List')->name('单据类型列表')->path('cboDocTypeList');
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Models\Component::where('code', 'like', 'cbo.%')->delete();
	}
}
