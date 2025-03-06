
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
        // Check if the table exists
        if (!Schema::hasTable('ic_submitted')) {
            // Create the table if it does not exist
            Schema::create('ic_submitted', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->string('submission_date')->nullable();
                $table->string('ip_created')->nullable();
                $table->string('user_created')->nullable();

            });
        } else {
            // Modify the existing table to add missing columns
            Schema::table('ic_submitted', function (Blueprint $table) {
                if (!Schema::hasColumn('ic_submitted', 'slug')) {
                    $table->string('slug')->nullable();
                }

                if (!Schema::hasColumn('ic_submitted', 'ip_created')) {
                    $table->string('ip_created')->nullable();
                }

                if (!Schema::hasColumn('ic_submitted', 'user_created')) {
                    $table->string('user_created')->nullable();
                }


                if (!Schema::hasColumn('ic_submitted', 'submission_date')) {
                    $table->string('submission_date')->nullable();
                }

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ic_submitted');
    }
};
