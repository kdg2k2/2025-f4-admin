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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('type_id')->constrained('document_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('uploader_id')->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('title');
            $table->integer('price');
            $table->text('path');
            $table->integer('download_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
