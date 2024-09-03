<?php

use App\Models\TempCallWeb;
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
        if (! Schema::hasColumn('temp_call_web', 'button_actor_id')) {
            Schema::table('temp_call_web', function (Blueprint $table) {
                $table->integer('button_actor_id')->nullable(false);
            });
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('temp_call_web', 'button_actor_id')) {
            Schema::table('temp_call_web', function (Blueprint $table) {
                $table->dropColumn('button_actor_id');
            });
        };
    }
};
