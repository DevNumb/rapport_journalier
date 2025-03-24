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
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'worker_id')) {
                $table->foreignId('worker_id');
            }
            if (!Schema::hasColumn('tasks', 'project_id')) {
                $table->foreignId('project_id');
            }

            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['worker_id']);
            $table->dropForeign(['project_id']);
            $table->dropColumn('worker_id');
            $table->dropColumn('project_id');
        });
    }
};
