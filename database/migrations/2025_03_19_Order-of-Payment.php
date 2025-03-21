<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_of_payment', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('ic_slug')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('year')->nullable();
            $table->date('date')->nullable();
            $table->string('fullname')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->string('tin')->nullable();
            $table->string('contact')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('amount_in_word')->nullable();
            $table->integer('lkg_bags')->nullable();
            $table->decimal('metric_tons', 10, 2)->nullable();
            $table->string('boc_entry_no')->nullable();
            $table->text('boc_entry_note')->nullable();
            $table->string('certified_correct')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamps();
            $table->ipAddress('ip_created')->nullable();
            $table->ipAddress('ip_updated')->nullable();
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_of_payment');
    }
};
