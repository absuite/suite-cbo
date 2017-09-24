<?php

use Gmf\Ac\Models\User;
use Gmf\Sys\Builder;
use Gmf\Sys\Models\Ent;
use Illuminate\Database\Seeder;

class CboUserSeeder extends Seeder {
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

		$b = new Builder;
		for ($i = 1; $i <= 10; $i++) {
			$b = new Builder;
			$b->account('amb' . $i . '@amb.com')->name('amb' . $i . '@amb.com')->password('amb' . $i . '@amb.com');
			$user = User::registerByAccount('sys', $b->toArray());

			Ent::addUser($this->entId, $user->id);
		}
	}
}
