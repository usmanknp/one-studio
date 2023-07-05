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
        Schema::create('classes_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('selected_offer_id')->constrained('classes_selected_offers');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('price', 8, 2);
            $table->datetime('payment_date');
            $table->enum('status',['INITIAL','CAPTURE','SUCCESS','FAILED']);
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
        Schema::dropIfExists('classes_payments');
    }
};
