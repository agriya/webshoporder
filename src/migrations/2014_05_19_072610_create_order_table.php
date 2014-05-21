<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order', function($table)
		{
			$table->increments('id');
			$table->integer('buyer_id');
			$table->double('total_amount');
			$table->double('site_commission');
			$table->string('currency', 100);
			$table->enum('order_status', array('draft','pending_payment','payment_completed','refund_requested','refund_completed','refund_rejected'))->default('draft');
			$table->string('pay_key');
			$table->string('tracking_id');
			$table->string('payment_status');
			$table->text('payment_response');
			$table->dateTime('date_created');
			$table->dateTime('date_updated');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order');
	}

}
