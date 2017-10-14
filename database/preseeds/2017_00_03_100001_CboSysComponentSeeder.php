<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CboSysComponentSeeder extends Seeder {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {
		$this->down();
		$exception = DB::transaction(function () {
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.language.list')->name('语言列表')->path('sysLanguageList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.language.edit')->name('语言')->path('sysLanguageEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.profile.list')->name('参数列表')->path('sysProfileList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.profile.edit')->name('参数')->path('sysProfileEdit');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.category.edit')->name('接口类型')->path('sysDtiCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.category.list')->name('接口类型列表')->path('sysDtiCategoryList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.param.edit')->name('接口参数')->path('sysDtiParamEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.param.list')->name('接口参数列表')->path('sysDtiParamList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.log.list')->name('接口日志')->path('sysDtiLogList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.item.edit')->name('接口')->path('sysDtiItemEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.item.list')->name('接口列表')->path('sysDtiItemList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityPermitEdit')->name('权限');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityPermitList')->name('权限列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleEdit')->name('角色');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleList')->name('角色列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleMenuEdit')->name('角色-菜单');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleMenuList')->name('角色-菜单列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleUserEdit')->name('角色-用户');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleUserList')->name('角色-用户列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRolePermitEdit')->name('角色-权限');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRolePermitList')->name('角色-权限列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleEntityEdit')->name('角色-数据');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleEntityList')->name('角色-数据列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysEntEdit')->name('企业');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysEntList')->name('企业列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('dashboard')->name('首页')->path('dashboard');
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Models\Component::where('code', 'dashboard')->delete();
		Models\Component::where('code', 'like', 'sys.%')->delete();
	}
}
