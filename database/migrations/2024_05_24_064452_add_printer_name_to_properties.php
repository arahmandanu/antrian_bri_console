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
        if (! Schema::hasColumn('properties', 'printer_name')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->string('printer_name')->nullable(true);
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
        if (Schema::hasColumn('properties', 'printer_name')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn('printer_name');
            });
        }
    }
};
