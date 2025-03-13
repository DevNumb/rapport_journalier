<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('log_name');
            $table->text('description');
            $table->string('subject_type');
            $table->unsignedBigInteger('subject_id');
            $table->string('causer_type');
            $table->unsignedBigInteger('causer_id');
            $table->timestamps();

            $table->foreign('causer_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
}
