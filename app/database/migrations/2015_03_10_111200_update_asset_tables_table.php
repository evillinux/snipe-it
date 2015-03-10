<?php

use Illuminate\Database\Migrations\Migration;

class UpdateAssetTablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Adds multiple fields to the asset table
		//
		Schema::table('assets', function ($table) {
			$table->string('ipaddr', 255)->nullable()->default(NULL);
			$table->string('bcrank', 255)->nullable()->default(NULL);
			$table->string('loc_rack', 255)->nullable()->default(NULL);
			$table->string('kvm', 255)->nullable()->default(NULL);
			$table->string('backup_solution', 255)->nullable()->default(NULL);
			$table->string('storage_solution', 255)->nullable()->default(NULL);
			$table->date('ship_date')->nullable()->default(NULL);
			$table->integer('company_id')->nullable()->default(NULL);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
