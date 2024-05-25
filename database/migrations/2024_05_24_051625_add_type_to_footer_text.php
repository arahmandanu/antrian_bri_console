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
        Schema::table('footer_texts', function (Blueprint $table) {
            if (! Schema::hasColumn('footer_texts', 'type')) {
                Schema::table('footer_texts', function (Blueprint $table) {
                    $table->string('type')->default('console');
                });
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('footer_texts', function (Blueprint $table) {
            if (Schema::hasColumn('footer_texts', 'type')) {
                Schema::table('footer_texts', function (Blueprint $table) {
                    $table->dropColumn('type');
                });
            }
        });
    }
};
