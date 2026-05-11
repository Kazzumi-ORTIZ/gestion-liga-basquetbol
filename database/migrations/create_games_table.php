<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('visitor_team_id')->constrained('teams')->onDelete('cascade');
            $table->dateTime('game_date');
            $table->integer('local_points')->nullable();
            $table->integer('visitor_points')->nullable();
            $table->enum('status', ['programado', 'terminado'])->default('programado');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
};