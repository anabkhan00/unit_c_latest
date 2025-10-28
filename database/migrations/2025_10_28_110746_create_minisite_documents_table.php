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
    Schema::create('minisite_documents', function (Blueprint $table) {
        $table->id();

        $table->string('document')->nullable();
        $table->string('document_title')->nullable();
        $table->unsignedBigInteger('document_added_by')->nullable();
        $table->unsignedBigInteger('team_id');

        // Foreign Keys
        $table->foreign('team_id')
              ->references('id')
              ->on('teams')
              ->onDelete('cascade');

        $table->foreign('document_added_by')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minisite_documents');
    }
};
