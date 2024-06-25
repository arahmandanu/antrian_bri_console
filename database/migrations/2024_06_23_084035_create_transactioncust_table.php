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
        if (! Schema::hasTable('transactioncust')) {
            Schema::create('transactioncust', function (Blueprint $table) {
                $table->string('BaseDt');
                $table->string('SeqNumber');
                $table->string('TrxDesc');
                $table->string('TimeTicket');
                $table->string('TimeCall');
                $table->string('CustWaitDuration');
                $table->string('UnitServe');
                $table->string('CounterNo');
                $table->string('Absent')->default('N');
                $table->string('UserId');
                $table->string('Flag');
                $table->string('TimeEnd');
                $table->string('Tservice');
                $table->string('TWservice');
                $table->string('TSLAservice');
                $table->string('TOverSLA');
                $table->string('synced')->default('N');
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
        Schema::dropIfExists('transactioncust');
    }
};
