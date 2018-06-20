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
		$exception = DB::transaction(function () {
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.language.list')->name('语言列表')->type_enum('ui')->path('sysLanguageList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.language.edit')->name('语言')->type_enum('ui')->path('sysLanguageEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.profile.list')->name('参数列表')->type_enum('ui')->path('sysProfileList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.profile.edit')->name('参数')->type_enum('ui')->path('sysProfileEdit');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.category.edit')->name('接口类型')->type_enum('ui')->path('sysDtiCategoryEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.category.list')->name('接口类型列表')->type_enum('ui')->path('sysDtiCategoryList');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.param.edit')->name('接口参数')->type_enum('ui')->path('sysDtiParamEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.param.list')->name('接口参数列表')->type_enum('ui')->path('sysDtiParamList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.log.list')->name('接口日志')->type_enum('ui')->path('sysDtiLogList');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.item.edit')->name('接口')->type_enum('ui')->path('sysDtiItemEdit');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sys.dti.item.list')->name('接口列表')->type_enum('ui')->path('sysDtiItemList');
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
				$builder->code('sysAuthorityRoleMenuEdit')->name('菜单权限');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleMenuList')->name('菜单权限列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleUserEdit')->name('角色用户');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleUserList')->name('角色用户列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRolePermitEdit')->name('操作权限');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRolePermitList')->name('操作权限列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleEntityEdit')->name('数据权限');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityRoleEntityList')->name('数据权限列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityUserRoleEdit')->name('用户角色');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysAuthorityUserRoleList')->name('用户角色列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('sysEntEdit')->name('企业');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('sysEntList')->name('企业列表');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('dashboard')->name('首页')->type_enum('ui')->path('dashboard');
			});

			Models\Component::build(function (Builder $builder) {
				$builder->code('SysPublishEnt')->name('发布企业');
			});
			Models\Component::build(function (Builder $builder) {
				$builder->code('SysPublishEntToken')->name('发布密钥');
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
