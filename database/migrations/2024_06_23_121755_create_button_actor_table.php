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
        Schema::create('button_actor', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('user_button_code')->nullable(false);
            $table->integer('counter_number')->nullable(false);
            $table->string('unit_service')->nullable(false);
            $table->string('last_queue_number')->nullable(true);
            $table->dateTime('last_queue_called')->nullable(true);
            $table->integer('originationcust_SeqDt')->nullable(true);
            $table->timestamps();

            $table->unique(['user_button_code', 'counter_number', 'unit_service']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('button_actor');
    }
};
