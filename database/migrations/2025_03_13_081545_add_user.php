<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['worker_id']);
            $table->dropColumn('worker_id');
        });
    }
};