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
        if (! Schema::hasTable('originationcust')) {
            Schema::create('originationcust', function (Blueprint $table) {
                $table->string('BaseDt');
                $table->string('SeqNumber');
                $table->string('UnitServe');
                $table->string('TimeTicket');
                $table->string('TimeCall')->nullable(true);
                $table->integer('origin_queue_number')->nullable(false);
                $table->string('WaitDuration')->nullable(true);
                $table->string('Flag');
                $table->integer('SeqDt', true);
                $table->string('DescTransaksi');
                $table->string('UnitCall');
                $table->string('code_trx');
                $table->string('SLA_Trx')->default('00:00:00');
                $table->integer('is_queue_online')->default(0);
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
        Schema::dropIfExists('originationcust');
    }
};
