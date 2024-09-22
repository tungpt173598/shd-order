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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('paper_type')->nullable();
            $table->string('paper_size')->nullable();
            $table->string('paper_quantity')->nullable();
            $table->string('print_zn')->nullable();
            $table->string('print_type')->nullable();
            $table->string('process_child_1')->nullable();
            $table->string('process_child_2')->nullable();
            $table->string('process_child_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_orders', function (Blueprint $table) {
            $table->dropColumn('paper_type');
            $table->dropColumn('paper_size');
            $table->dropColumn('paper_quantity');
            $table->dropColumn('print_zn');
            $table->dropColumn('print_type');
            $table->dropColumn('process_child_1');
            $table->dropColumn('process_child_2');
            $table->dropColumn('process_child_3');
        });
    }
};
