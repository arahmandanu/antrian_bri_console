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
        if (!Schema::hasTable('trxparam')) {
            Schema::create('trxparam', function (Blueprint $table) {
                $table->string('TrxCode')->primary();
                $table->string('TrxName')->nullable(false);
                $table->string('UnitService')->nullable(false);
                $table->string('Tservice')->default('00:00:00')->nullable(false);
                $table->integer('displayed')->default(1)->nullable(false);
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
        Schema::dropIfExists('trxparam');
    }
};
