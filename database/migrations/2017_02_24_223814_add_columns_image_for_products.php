<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsImageForProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	\DB::statement('ALTER TABLE `products` ADD `image1` LONGBLOB');
    	\DB::statement('ALTER TABLE `products` ADD `mime` VARCHAR(30)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
        	$table->dropColumn('image1');
        	$table->dropColumn('mime');
        });
    }
}
