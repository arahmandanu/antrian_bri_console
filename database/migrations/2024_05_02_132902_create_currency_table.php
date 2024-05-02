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
        Schema::create('currency', function (Blueprint $table) {
            $table->id();
            $table->string('flag_url')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('jual_a')->nullable(false);
            $table->string('beli_a')->nullable(false);
            $table->string('jual_b')->nullable(false);
            $table->string('beli_b')->nullable(false);
            $table->boolean('show')->nullable(false)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency');
    }
};
