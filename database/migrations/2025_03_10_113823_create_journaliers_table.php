<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournaliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journaliers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('projet');
            $table->time('duree_debut'); // Store time for start time
            $table->time('duree_fin');   // Store time for end time
            $table->text('description')->nullable();
            $table->date('date'); // Added date column
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
        Schema::dropIfExists('journaliers');
    }
}
