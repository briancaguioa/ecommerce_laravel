<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemidOrdeidQuantityItemOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_order', function (Blueprint $table) {
          $table->integer("quatity");
            $table->unsignedInteger("item_id");
            $table->unsignedInteger("order_id");

            //foreign keys
            $table->foreign('item_id')
            ->references('id')
            ->on('items') // reference to items
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('order_id')
            ->references('id')
            ->on('orders') //reference to orders
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_order', function (Blueprint $table) {
            //
        });
    }
}
