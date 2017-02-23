<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToItemsOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('items_orders', function(Blueprint $table)
		{
			$table->foreign('orders_id', 'fk_items_orders_orders1')->references('id')->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('products_id', 'fk_orders_products1')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('items_orders', function(Blueprint $table)
		{
			$table->dropForeign('fk_items_orders_orders1');
			$table->dropForeign('fk_orders_products1');
		});
	}

}
