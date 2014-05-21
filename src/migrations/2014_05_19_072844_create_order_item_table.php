<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_item', function($table)
		{
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('item_id');
			$table->integer('buyer_id');
			$table->integer('item_owner_id');
			$table->double('item_amount');
			$table->double('services_amount');
			$table->double('total_amount');
			$table->string('service_ids');
			$table->enum('item_type', array('product'))->default('product');
			$table->double('site_commission');
			$table->double('seller_amount');
			$table->dateTime('date_added');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_item');
	}

}
