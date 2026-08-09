<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up() : void
	{
		Schema::create('clothes_season', function (Blueprint $table) {
			$table->id();
			$table->foreignId('clothes_id')->references('id')->on('clothes')->constrained()->onDelete('cascade');
			$table->foreignId('season_id')->references('id')->on('seasons')->constrained()->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down() : void
	{
		Schema::dropIfExists('clothes_season');
	}
};
