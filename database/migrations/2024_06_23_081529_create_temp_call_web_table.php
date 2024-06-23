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
        if (!Schema::hasTable('temp_call_web')) {
            Schema::create('temp_call_web', function (Blueprint $table) {
                $table->id();
                $table->string('Counter')->nullable(false);
                $table->string('Unit')->nullable(false);
                $table->string('SeqNumber')->nullable(false);
                $table->string('Tampil', 1)->default('n')->nullable(false);
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
        Schema::dropIfExists('temp_call_web');
    }
};
