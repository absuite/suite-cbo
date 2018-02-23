<?php
use Gmf\Sys\Builder;
use Gmf\Sys\Models;
use Illuminate\Database\Seeder;

class CboDtiLocalSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/orgs/batch")->name("组织")->path('api/cbo/orgs/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/currencies/batch")->name("币种")->path('api/cbo/currencies/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/units/batch")->name("计量单位")->path('api/cbo/units/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/depts/batch")->name("部门")->path('api/cbo/depts/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/works/batch")->name("工作中心")->path('api/cbo/works/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/whs/batch")->name("存储地点")->path('api/cbo/whs/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/persons/batch")->name("人员")->path('api/cbo/persons/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/project-categories/batch")->name("项目分类")->path('api/cbo/project-categories/batch');
		});
		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/projects/batch")->name("项目")->path('api/cbo/projects/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/item-categories/batch")->name("物料分类")->path('api/cbo/item-categories/batch');
		});
		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/items/batch")->name("物料")->path('api/cbo/items/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/trader-categories/batch")->name("客商分类")->path('api/cbo/trader-categories/batch');
		});
		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/traders/batch")->name("客商")->path('api/cbo/traders/batch');
		});

		Models\DtiLocal::build(function (Builder $b) {
			$b->method_enum('post')->code("api/cbo/doc-types/batch")->name("单据类型")->path('api/cbo/doc-types/batch');
		});
	}
}
