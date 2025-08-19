<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_of_payment', function (Blueprint $table) {
            $table->text('designation_cert_correct')->nullable();
            $table->text('designation_approve_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_of_payment', function (Blueprint $table) {
            $table->text('designation_cert_correct')->nullable();
            $table->text('designation_approve_by')->nullable();
        });
    }
};
