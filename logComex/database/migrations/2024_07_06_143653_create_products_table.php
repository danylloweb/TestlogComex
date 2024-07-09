<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->index();
            $table->text('description')->nullable();
            $table->decimal('price',10,2);
            $table->smallInteger('status')->default(1)->index();
            $table->smallInteger('warranty')->default(2)->index();
            $table->char('type',20)->default('Novo')->index();
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}
};
