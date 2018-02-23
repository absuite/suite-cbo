<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CboMenuSeeder extends Seeder {
	private $sequence = '12';
	private $tag = 'e1742e00420e11e79d1897dbf903cb38';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function run() {
		$id = "1e53c280421611e79933851f36ce39f8";
		Menu::build(function (Builder $builder) use ($id) {
			$builder->id($id)->root_id($id)->code('cbo')->name('数据管理')
				->sequence($this->sequence . '0000')->tag($this->tag);
		});

		$exception = DB::transaction(function () {
			$id = "d8540a600a0311e785189b0fc663edd9";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.base')->name('公共基础')->parent('cbo')
					->sequence($this->sequence . '0000')->tag($this->tag);
			});

			// $id = "a28f6f700a0a11e7a493ef336e695fd8";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.address.country')->name('国家/地区')->parent('cbo.base')
			// 		->uri('cbo.country.list')->sequence($this->sequence . '0202')->tag($this->tag);
			// });
			$id = "a28f6fe00a0a11e78a24a3c3944e1248";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.address.area')->name('区域')->parent('cbo.base')
					->uri('cbo.area.list')->sequence($this->sequence . '0204')->tag($this->tag);
			});

			// $id = "8ed8d8404e6a11e7913b5f54cc8e2606";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.address.province')->name('省份')->parent('cbo.base')
			// 		->uri('cbo.province.list')->sequence($this->sequence . '0205')->tag($this->tag);
			// });

			$id = "a28f70600a0a11e78f079f9e5ad5dcaa";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.address.division')->name('城市区县')->parent('cbo.base')
					->uri('cbo.division.list')->sequence($this->sequence . '0206')->tag($this->tag);
			});

			$id = "74cca4600a0b11e7b353d96022d2d0df";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.setting.unit')->name('计量单位')->parent('cbo.base')
					->uri('cbo.unit.list')->sequence($this->sequence . '0208')->tag($this->tag);
			});
			$id = "74cca5400a0b11e7bbe39513fefc51be";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.setting.currency')->name('币种')->parent('cbo.base')
					->uri('cbo.currency.list')->sequence($this->sequence . '0210')->tag($this->tag);
			});

			//地址
			// $id = "a28f6f000a0a11e79c751d22c652d45f";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.address')->name('地址')->parent('cbo.base')
			// 		->uri('cbo.address.list')->sequence($this->sequence . '0212')->tag($this->tag);
			// });

			$id = "36b85a700a0b11e7b29d19a90ef057eb";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.period.calendar')->name('会计日历')->parent('cbo.base')
					->uri('cbo.period.calendar.list')->sequence($this->sequence . '0214')->tag($this->tag);
			});

			$id = "d8540c400a0311e78a2b93658d06a5a4";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.org')->name('组织')->parent('cbo.base')
					->uri('cbo.org.list')->sequence($this->sequence . '0302')->tag($this->tag);
			});
			$id = "d8540ce00a0311e782168b802ae641fe";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.dept')->name('部门')->parent('cbo.base')
					->uri('cbo.dept.list')->sequence($this->sequence . '0304')->tag($this->tag);
			});
			$id = "d8540d400a0311e7a09d111e03f0b260";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.work')->name('工作中心')->parent('cbo.base')
					->uri('cbo.work.list')->sequence($this->sequence . '0306')->tag($this->tag);
			});
			$id = "d8540da00a0311e7b66a035a9e6c2a3c";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.team')->name('班组')->parent('cbo.base')
					->uri('cbo.team.list')->sequence($this->sequence . '0308')->tag($this->tag);
			});

			$id = "2e6779600a0b11e7a7b559c7d96adb02";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.person.person')->name('人员')->parent('cbo.base')
					->uri('cbo.person.list')->sequence($this->sequence . '0310')->tag($this->tag);
			});
		});

		$exception = DB::transaction(function () {
			$id = "843d0f800a0b11e79282fdcab5b97bfe";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.pub')->name('业务基础')->parent('cbo')
					->sequence($this->sequence . '0000')->tag($this->tag);
			});

			//物料
			$id = "c6cf30500a0a11e78f81c72d4d010df0";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.item.category')->name('物料分类')->parent('cbo.pub')
					->uri('cbo.item.category.list')->sequence($this->sequence . '0402')->tag($this->tag);
			});
			$id = "c6cf30e00a0a11e7911007a1550c6a1d";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.item.item')->name('料品')->parent('cbo.pub')
					->uri('cbo.item.list')->sequence($this->sequence . '0404')->tag($this->tag);
			});

			//客商
			$id = "614ba6700a0b11e7b4b36f2b36cb3070";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.trader.category')->name('客商分类')->parent('cbo.pub')
					->uri('cbo.trader.category.list')->sequence($this->sequence . '0406')->tag($this->tag);
			});
			$id = "614ba2f00a0b11e792800fcda0b10aa9";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.trader.trader')->name('客商')->parent('cbo.pub')
					->uri('cbo.trader.list')->sequence($this->sequence . '0408')->tag($this->tag);
			});
			//厂牌
			// $id = "50e65b200a0b11e7adbc87796f3f83a8";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.mfc.category')->name('厂牌分类')->parent('cbo.pub')
			// 		->uri('cbo.mfc.category.list')->sequence($this->sequence . '0410')->tag($this->tag);
			// });
			// $id = "50e658d00a0b11e7b60b89424846759d";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.mfc.mfc')->name('厂牌')->parent('cbo.pub')
			// 		->uri('cbo.mfc.list')->sequence($this->sequence . '0412')->tag($this->tag);
			// });
			//存储地点
			$id = "225de9800a0b11e7945fa35c2a54b6aa";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.wh.wh')->name('存储地点')->parent('cbo.pub')
					->uri('cbo.wh.list')->sequence($this->sequence . '0414')->tag($this->tag);
			});
			//项目
			// $id = "156653000a0b11e78859253b0b343559";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.project.category')->name('项目分类')->parent('cbo.pub')
			// 		->uri('cbo.project.category.list')->sequence($this->sequence . '0416')->tag($this->tag);
			// });
			// $id = "156652700a0b11e7bbda71d0eed97c22";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.project.project')->name('项目')->parent('cbo.pub')
			// 		->uri('cbo.project.list')->sequence($this->sequence . '0418')->tag($this->tag);
			// });

			//批号
			// $id = "0a807d600a0b11e794f3d566d1a4e87a";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.lot.lot')->name('批号')->parent('cbo.pub')
			// 		->uri('cbo.lot.list')->sequence($this->sequence . '0420')->tag($this->tag);
			// });

			// $id = "f763a930482611e7a4b61db683a97cf3";
			// Menu::build(function (Builder $builder) use ($id) {
			// 	$builder->id($id)->code('cbo.resource.resource')->name('资源')->parent('cbo.pub')
			// 		->uri('cbo.resource.list')->sequence($this->sequence . '0422')->tag($this->tag);
			// });

			$id = "c0258740483811e7b76b7d6cf43243a4";
			Menu::build(function (Builder $builder) use ($id) {
				$builder->id($id)->code('cbo.doc.type')->name('单据类型')->parent('cbo.pub')
					->uri('cbo.doc.type.list')->sequence($this->sequence . '0424')->tag($this->tag);
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Menu::where('code', 'like', 'cbo%')->delete();
	}
}
