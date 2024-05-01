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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('customer')->nullable();
            $table->string('price')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('payment_type')->default(0);
            $table->integer('pre_charge')->default(0);
            $table->string('paper_supplier')->nullable();
            $table->boolean('paper_done')->default(0);
            $table->string('printed_by')->nullable();
            $table->boolean('print_done')->default(0);
            $table->string('design')->nullable();
            $table->boolean('design_done')->default(0);
            $table->string('machining')->nullable();
            $table->boolean('machining_done')->default(0);
            $table->string('pack')->nullable();
            $table->boolean('pack_done')->default(0);
            $table->string('deliver')->nullable();
            $table->boolean('deliver_done')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
};
