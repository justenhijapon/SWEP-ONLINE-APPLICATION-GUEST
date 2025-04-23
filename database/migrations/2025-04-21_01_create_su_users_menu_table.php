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
        Schema::create('su_user_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('user_menu_id');
            $table->string('category');
            $table->string('name');
            $table->string('route')->nullable();
            $table->boolean('is_menu')->default(0);
            $table->boolean('is_dropdown')->default(0);
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
        Schema::dropIfExists('su_user_menus');
    }
};
