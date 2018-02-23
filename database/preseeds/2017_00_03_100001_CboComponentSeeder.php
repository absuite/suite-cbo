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
		$exception = DB::transaction(function () {
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Org.Edit')->name('组织')->type_enum('ui')->path('cboOrgEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Org.List')->name('组织列表')->type_enum('ui')->path('cboOrgList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Dept.Edit')->name('部门')->type_enum('ui')->path('cboDeptEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Dept.List')->name('部门列表')->type_enum('ui')->path('cboDeptList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Work.Edit')->name('工中中心')->type_enum('ui')->path('cboWorkEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Work.List')->name('工中中心列表')->type_enum('ui')->path('cboWorkList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Team.Edit')->name('班组')->type_enum('ui')->path('cboTeamEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Team.List')->name('班组列表')->type_enum('ui')->path('cboTeamList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Area.Edit')->name('区域')->type_enum('ui')->path('cboAreaEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Area.List')->name('区域列表')->type_enum('ui')->path('cboAreaList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Country.Edit')->name('国家')->type_enum('ui')->path('cboCountryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Country.List')->name('国家列表')->type_enum('ui')->path('cboCountryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Currency.Edit')->name('币种')->type_enum('ui')->path('cboCurrencyEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Currency.List')->name('币种列表')->type_enum('ui')->path('cboCurrencyList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Province.Edit')->name('城市区县')->type_enum('ui')->path('cboProvinceEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Province.List')->name('城市区县列表')->type_enum('ui')->path('cboProvinceList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Division.Edit')->name('城市区县')->type_enum('ui')->path('cboDivisionEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Division.List')->name('城市区县列表')->type_enum('ui')->path('cboDivisionList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Item.Edit')->name('物料')->type_enum('ui')->path('cboItemEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Item.List')->name('物料列表')->type_enum('ui')->path('cboItemList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Item.Category.Edit')->name('物料分类')->type_enum('ui')->path('cboItemCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Item.Category.List')->name('物料分类列表')->type_enum('ui')->path('cboItemCategoryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Lot.Edit')->name('批号')->type_enum('ui')->path('cboLotEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Lot.List')->name('批号列表')->type_enum('ui')->path('cboLotList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Mfc.Category.Edit')->name('厂牌分类')->type_enum('ui')->path('cboMfcCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Mfc.Category.List')->name('厂牌分类列表')->type_enum('ui')->path('cboMfcCategoryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Mfc.Edit')->name('厂牌')->type_enum('ui')->path('cboMfcEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Mfc.List')->name('厂牌列表')->type_enum('ui')->path('cboMfcList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Period.Account.List')->name('期间')->type_enum('ui')->path('cboPeriodAccountList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Period.Calendar.Edit')->name('日历')->type_enum('ui')->path('cboPeriodCalendarEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Period.Calendar.List')->name('日历列表')->type_enum('ui')->path('cboPeriodCalendarList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Person.Edit')->name('人员')->type_enum('ui')->path('cboPersonEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Person.List')->name('人员列表')->type_enum('ui')->path('cboPersonList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Project.Category.Edit')->name('项目分类')->type_enum('ui')->path('cboProjectCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Project.Category.List')->name('项目分类列表')->type_enum('ui')->path('cboProjectCategoryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Project.Edit')->name('项目')->type_enum('ui')->path('cboProjectEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Project.List')->name('项目列表')->type_enum('ui')->path('cboProjectList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Trader.Category.Edit')->name('客商分类')->type_enum('ui')->path('cboTraderCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Trader.Category.List')->name('客商分类列表')->type_enum('ui')->path('cboTraderCategoryList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Trader.Edit')->name('客商')->type_enum('ui')->path('cboTraderEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Trader.List')->name('客商列表')->type_enum('ui')->path('cboTraderList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Unit.Edit')->name('计量单位')->type_enum('ui')->path('cboUnitEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Unit.List')->name('计量单位列表')->type_enum('ui')->path('cboUnitList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Wh.Edit')->name('存储地点')->type_enum('ui')->path('cboWhEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Wh.List')->name('存储地点列表')->type_enum('ui')->path('cboWhList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Doc.Type.Edit')->name('单据类型')->type_enum('ui')->path('cboDocTypeEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('cbo.Doc.Type.List')->name('单据类型列表')->type_enum('ui')->path('cboDocTypeList');
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
