<?php

namespace App\Observers;

use App\Models\Clothes;

class ClothesObserver
{
	/**
	 * @param  Clothes $clothes
	 * @return void
	 */
	public function updated(Clothes $clothes)
	{
		if (!$clothes->isDirty('filename')) {
			return;
		}

		$filename = $clothes->getOriginal('filename');
		if (!$filename) {
			return;
		}

		$path = public_path($filename);
		if (file_exists($path)) {
			unlink($path);
		}
	}

	/**
	 * @param  Clothes $clothes
	 * @return void
	 */
	public function deleted(Clothes $clothes)
	{
		if (!$clothes->filename) {
			return;
		}

		$path = public_path($clothes->filename);
		if (file_exists($path)) {
			unlink($path);
		}
	}
}
