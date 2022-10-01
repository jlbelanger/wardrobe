<?php

namespace App\Observers;

use App\Models\Clothes;

class ClothesObserver
{
	/**
	 * @param  Clothes $clothes
	 * @return void
	 */
	public function updating(Clothes $clothes)
	{
		if (!$clothes->isDirty('name')) {
			return;
		}

		// Rename files to match new name.
		if ($clothes->filename) {
			$oldFilename = $clothes->filename;
			$newFilename = $clothes->uploadedFilename('filename', $oldFilename);
			$oldPath = public_path($oldFilename);
			$newPath = public_path($newFilename);
			if (file_exists($oldPath) && !file_exists($newPath)) {
				$folder = preg_replace('/\/[^\/]+$/', '', $newPath);
				if (!is_dir($folder)) {
					mkdir($folder);
				}
				rename($oldPath, $newPath);
				$clothes->filename = $newFilename;
			}
		}
	}

	/**
	 * @param  Clothes $clothes
	 * @return void
	 */
	public function updated(Clothes $clothes)
	{
		// When uploading or removing file, delete the old file.
		if ($clothes->isDirty('filename')) {
			$filename = $clothes->getOriginal('filename');
			if ($filename) {
				$path = public_path($filename);
				if (file_exists($path)) {
					unlink($path);
				}
			}
		}
	}

	/**
	 * @param  Clothes $clothes
	 * @return void
	 */
	public function deleted(Clothes $clothes)
	{
		// Delete associated files.
		if ($clothes->filename) {
			$path = public_path($clothes->filename);
			if (file_exists($path)) {
				unlink($path);
			}
		}
	}
}
