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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('original_name', 255);
            $table->string('file_name', 255)->unique();
            $table->string('file_path', 1000);
            $table->string('mime_type', 255);
            $table->unsignedBigInteger('size');
            $table->string('description', 255)->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('visibility')->default(1)->comment('1:private, 2:area, 3:public');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
