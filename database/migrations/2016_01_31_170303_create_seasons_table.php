<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Runs the migrations.
	 *
	 * @return void
	 */
	public function up() : void
	{
		Schema::create('seasons', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('start_date', 5);
			$table->string('end_date', 5);
			$table->integer('order_num')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverses the migrations.
	 *
	 * @return void
	 */
	public function down() : void
	{
		Schema::dropIfExists('seasons');
	}
};
