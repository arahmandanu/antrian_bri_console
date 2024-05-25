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
        if (! Schema::hasColumn('properties', 'footer_flow_kios')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->enum('footer_flow_kios', ['left', 'right'])->default('right');
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
        if (Schema::hasColumn('properties', 'footer_flow_kios')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn('footer_flow_kios');
            });
        }
    }
};
