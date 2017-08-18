<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('delivery_type')->comment('1. domicilio 2. en local');
			$table->integer('status')->default(1)->comment('1. Pendiente, 2. Confirmado, 3. Cancelado, 4. Entregado.');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('users_id')->unsigned()->index('fk_orders_users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
