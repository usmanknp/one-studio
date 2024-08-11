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
        Schema::create('task_spare_parts', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id');
            $table->integer('spare_parts_id');
            $table->string('spare_parts_code');
            $table->string('spare_parts_name');
            $table->integer('spare_parts_quantity')->nullable()->default(0);
            $table->text('spare_parts_description')->nullable();
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
        Schema::dropIfExists('task_spare_parts');
    }
};
