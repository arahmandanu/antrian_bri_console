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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', length: 244)->nullable(false);
            $table->string('company_code', length: 244)->nullable(false);
            $table->string('footer_text', length: 244)->nullable(false);
            $table->boolean('show_product')->nullable(false)->default(true);
            $table->boolean('show_currency')->nullable(false)->default(true);
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
        Schema::dropIfExists('properties');
    }
};
