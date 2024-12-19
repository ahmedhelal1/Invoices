<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_invoices');
            $table->foreign('id_invoices')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('invoice_number', 50);
            $table->string('product', 50);
            $table->unsignedBigInteger('section');
            $table->foreign('section')->references('id')->on('sections')->onDelete('cascade');
            $table->string('status', 50);
            $table->date('payment_date')->nullable();
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->string('user', 300);
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
        Schema::dropIfExists('invoices_details');
    }
};
