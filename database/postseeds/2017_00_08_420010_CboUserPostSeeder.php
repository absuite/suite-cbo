<?php

use Gmf\Sys\Builder;
use Gmf\Sys\Models\Authority\RoleUser;
use Gmf\Sys\Models\Ent;
use Gmf\Sys\Models\User;
use Illuminate\Database\Seeder;

class CboUserPostSeeder extends Seeder {
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
			$b->account('amb' . $i . '@amb.com')
				->name('amb' . $i . '@amb.com')
				->password('amb' . $i . '@amb.com')
				->client_id(config('gmf.client.id'));
			$user = User::registerByAccount('sys', $b->toArray());

			Ent::addUser($this->entId, $user->id);

			RoleUser::build(function (Builder $b) use ($user) {
				$b->ent_id($this->entId)->user_id($user->id)->role('suite.role.sys.super');
			});
		}
	}
}
