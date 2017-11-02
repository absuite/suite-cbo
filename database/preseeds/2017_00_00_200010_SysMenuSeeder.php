<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SysMenuSeeder extends Seeder {
	private $sequence = '80';
	private $tag = 'e1742e00420e11e79d1897dbf903cb38';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {

		$exception = DB::transaction(function () {
			$id = "c8280c0009f311e797dccd79a400c99f";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->root_id($id)->code('sys')->name('系统运营')
					->uri('sys')->sequence($this->sequence . '0000')->tag($this->tag);
			});
			//企业管理
			// $id = "c8280e2009f311e79f49d90c5fb2cdc1";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.ent')->name('企业管理')->parent('sys')
			// 		->sequence($this->sequence . '0100')->tag($this->tag);
			// });
			// //企业
			// $id = "a8f2354009f511e78680598d785435bd";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.ent.list')->name('企业管理')->parent('sys.ent')
			// 		->uri('sys.ent.list')->sequence($this->sequence . '0501')->tag($this->tag);
			// });

			// $id = "c8280f4009f311e7b89065113bb45fff";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.setting.profile')->name('参数管理')->parent('sys.ent')
			// 		->uri('sys.profile.list')->sequence($this->sequence . '0102')->tag($this->tag);
			// });
			// $id = "c828113009f311e7b027d722a9f64aa3";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.menu.list')->name('应用管理')->parent('sys.ent')
			// 		->uri('sys.menu.list')->sequence($this->sequence . '0201')->tag($this->tag);
			// });

			//授权管理
			$id = "6264bdc0b0a211e7bbcd0b83f0aa9283";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.authority')->name('授权管理')->parent('sys')
					->sequence($this->sequence . '0400')->tag($this->tag);
			});

			$id = "6264c180b0a211e78974bb13c32073b7";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.authority.role')->name('角色管理')->parent('sys.authority')
					->uri('sys.authority.role.list')->sequence($this->sequence . '0104')->tag($this->tag);
			});
			$id = "6264c2d0b0a211e7a06455dcad2290f4";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.authority.role.user')->name('角色用户')->parent('sys.authority')
					->uri('sys.authority.role.user.list')->sequence($this->sequence . '0401')->tag($this->tag);
			});
			$id = "6264c3a0b0a211e78231c3dc846e0b14";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.authority.role.menu')->name('菜单权限')->parent('sys.authority')
					->uri('sys.authority.role.menu.list')->sequence($this->sequence . '0403')->tag($this->tag);
			});
			$id = "6264c410b0a211e79be7cfff31831c8a";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.authority.role.permit')->name('操作权限')->parent('sys.authority')
					->uri('sys.authority.role.permit.list')->sequence($this->sequence . '0405')->tag($this->tag);
			});
			$id = "6264c480b0a211e78551db2664049ee1";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.authority.role.entity')->name('数据权限')->parent('sys.authority')
					->uri('sys.authority.role.entity.list')->sequence($this->sequence . '0407')->tag($this->tag);
			});

			$id = "933e3d40b4db11e7a3e8a1a881f3a069";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.authority.user.edit')->name('用户角色')->parent('sys.authority')
					->uri('sys.authority.user.role.edit')->sequence($this->sequence . '0409')->tag($this->tag);
			});
			//日志
			// $id = "225ab7a00a0111e7aa6b651fe5aa9d72";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.log')->name('日志')->parent('sys')
			// 		->sequence($this->sequence . '0600')->tag($this->tag);
			// });
			// $id = "225ab8a00a0111e7bab713d1c0e27d8e";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.log.login')->name('登录日志')->parent('sys.log')
			// 		->uri('sys.log.login.list')->sequence($this->sequence . '0601')->tag($this->tag);
			// });
			// $id = "225ab8f00a0111e7a1f9bba118b299df";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.log.action')->name('操作日志')->parent('sys.log')
			// 		->uri('sys.log.action.list')->sequence($this->sequence . '0602')->tag($this->tag);
			// });
			// $id = "225ab9500a0111e7b68083d568feadf5";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.log.error')->name('错误日志')->parent('sys.log')
			// 		->uri('sys.log.error.list')->sequence($this->sequence . '0603')->tag($this->tag);
			// });

			//调度请求
			// $id = "d42debc00a0111e78c4f2b84de6b92f0";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.job')->name('调度请求')->parent('sys')
			// 		->sequence($this->sequence . '0700')->tag($this->tag);
			// });
			// $id = "d42dee400a0111e7ad6ab3f0b2404491";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.job.request')->name('请求管理')->parent('sys.job')
			// 		->uri('sys.job.request.list')->sequence($this->sequence . '0701')->tag($this->tag);
			// });
			// $id = "d42defa00a0111e786a9472ee3e95a55";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.job.schem')->name('请求方案')->parent('sys.job')
			// 		->uri('sys.job.schem.list')->sequence($this->sequence . '0702')->tag($this->tag);
			// });
			// $id = "d42def100a0111e79bdb176cf74d4e6d";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('sys.job.log')->name('请求日志')->parent('sys.job')
			// 		->uri('sys.job.log')->sequence($this->sequence . '0703')->tag($this->tag);
			// });

			//接口管理
			$id = "5431fd400a0211e7ae0c318ab71dd38b";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.dti')->name('接口')->parent('sys')
					->sequence($this->sequence . '0800')->tag($this->tag);
			});
			$id = "5431ff500a0211e7acf66b5205c6a513";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.dti.category')->name('接口类型')->parent('sys.dti')
					->uri('sys.dti.category.list')
					->sequence($this->sequence . '0801')->tag($this->tag);
			});
			$id = "5431ffe00a0211e793d7af8c60f451f5";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.dti.param')->name('参数配置')->parent('sys.dti')
					->uri('sys.dti.param.list')->sequence($this->sequence . '0801')->tag($this->tag);
			});
			$id = "543200a00a0211e78407c1a122980e01";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.dti.item')->name('接口定义')->parent('sys.dti')
					->uri('sys.dti.item.list')->sequence($this->sequence . '0802')->tag($this->tag);
			});

			$id = "543202000a0211e798a3b93bad0d1f8f";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('sys.dti.log')->name('接口日志')->parent('sys.dti')
					->uri('sys.dti.log.list')->sequence($this->sequence . '0805')->tag($this->tag);
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Menu::where('code', 'like', 'sys%')->delete();
	}
}
