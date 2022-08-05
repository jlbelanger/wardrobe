<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClothesTable extends Migration
{
	/**
	 * Runs the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clothes', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('filename');
			$table->foreignId('category_id')->references('id')->on('categories')->constrained()->onDelete('restrict');
			$table->foreignId('colour_id')->references('id')->on('colours')->constrained()->onDelete('restrict');
			$table->boolean('is_default')->default(false);
			$table->boolean('is_patterned')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverses the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('clothes');
	}
}
