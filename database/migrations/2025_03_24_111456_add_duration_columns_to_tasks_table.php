<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Add duree_debut and duree_fin after description
            $table->time('duree_debut')->nullable()->after('description');
            $table->time('duree_fin')->nullable()->after('duree_debut');

            // Add hours column AFTER duree_fin
            $table->float('hours', 8, 2)->nullable()->after('duree_fin');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Drop the added columns in reverse order
            $table->dropColumn(['hours', 'duree_fin', 'duree_debut']);
        });
    }
};
