<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentInBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->date('transfer_date')->nullable();
            $table->string('account_number')->nullable();
            $table->string('to_bank')->nullable();
            $table->string('on_behalf_of')->nullable();
            $table->integer('total_transfers')->nullable();
            $table->integer('remaining_payment')->nullable();
            $table->string('evidence_of_transfer')->nullable();
            $table->integer('payment_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            //
        });
    }
}
