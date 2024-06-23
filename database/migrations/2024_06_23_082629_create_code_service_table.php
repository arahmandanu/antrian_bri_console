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
        if (!Schema::hasTable('codeservice')) {
            Schema::create('codeservice', function (Blueprint $table) {
                $table->string('Initial')->nullable(false);
                $table->string('Name')->nullable(false);
                $table->integer('CurrentQNo')->default(0)->nullable(false);
                $table->integer('last_queue')->default(0)->nullable(false);
                $table->timestamps();
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
        Schema::dropIfExists('codeservice');
    }
};
