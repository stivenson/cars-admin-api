<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items_orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('products_id')->index('fk_orders_products1_idx');
			$table->integer('amount')->default(1);
			$table->string('observations', 1000);
			$table->integer('orders_id')->index('fk_items_orders_orders1_idx');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('items_orders');
	}

}
