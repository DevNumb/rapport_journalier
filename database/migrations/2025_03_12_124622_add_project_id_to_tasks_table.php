<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProjectIdToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('project_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('project_id')->nullable()->change();
        });
    }
}
