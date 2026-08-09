<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up() : void
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug');
			$table->integer('order_num')->default(0);
			$table->integer('order_num_footer')->default(0);
			$table->integer('is_default')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down() : void
	{
		Schema::dropIfExists('categories');
	}
};
