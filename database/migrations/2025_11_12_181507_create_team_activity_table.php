<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('team_activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id'); // foreign key
            $table->unsignedBigInteger('user_id'); // foreign key
            $table->string('activity_name');
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign key constraint (agar teams table exist karti ho)
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_activity');
    }
};
