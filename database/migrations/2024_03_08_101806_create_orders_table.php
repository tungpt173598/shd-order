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
            $table->string('payment_status')->default(0);
            $table->string('paper_supplier')->nullable();
            $table->string('printed_by')->nullable();
            $table->string('design')->nullable();
            $table->string('paper_supplier')->nullable();
            $table->string('paper_supplier')->nullable();
            $table->string('paper_supplier')->nullable();
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
