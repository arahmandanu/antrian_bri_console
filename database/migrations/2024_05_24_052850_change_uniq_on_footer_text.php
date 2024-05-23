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
            $table->dropUnique('footer_texts_display_number_unique');

            $table->unique(['display_number', 'type']);
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
            $table->unique('display_number');
            $table->dropUnique('footer_texts_display_number_type_unique');
        });
    }
};
