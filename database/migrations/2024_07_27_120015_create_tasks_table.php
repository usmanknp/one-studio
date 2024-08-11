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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->integer('task_type_id');
            $table->string('track_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('assign_to')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('status');
            $table->dateTime('occurred_at');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('approval_status',['PENDING','APPROVED']);
            $table->integer('approved_by')->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->string('total_time')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('tasks');
    }
};
