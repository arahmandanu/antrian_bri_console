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
        if (! Schema::hasColumn('codeservice', 'is_reset_counter')) {
            Schema::table('codeservice', function (Blueprint $table) {
                $table->boolean('is_reset_counter')->nullable(false)->default(false);
            });
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('codeservice', 'is_reset_counter')) {
            Schema::table('codeservice', function (Blueprint $table) {
                $table->dropColumn('is_reset_counter');
            });
        };
    }
};
