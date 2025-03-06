
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
        if (!Schema::hasTable('ic_revoked')) {
            // Create the table if it does not exist
            Schema::create('ic_revoked', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->string('submission_date')->nullable();
                $table->string('ip_created')->nullable();
                $table->string('user_created')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        } else {
            // Modify the existing table to add missing columns
            Schema::table('ic_revoked', function (Blueprint $table) {
                if (!Schema::hasColumn('ic_revoked', 'slug')) {
                    $table->string('slug')->nullable();
                }

                if (!Schema::hasColumn('ic_revoked', 'ip_created')) {
                    $table->string('ip_created')->nullable();
                }

                if (!Schema::hasColumn('ic_revoked', 'user_created')) {
                    $table->string('user_created')->nullable();
                }

                if (!Schema::hasColumn('ic_revoked', 'submission_date')) {
                    $table->string('submission_date')->nullable();
                }

                if (!Schema::hasColumn('ic_revoked', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }

                if (!Schema::hasColumn('ic_revoked', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('ic_revoked');
    }
};
