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
        Schema::create('media', function (Blueprint $table) {

            $table->id();

            $table->foreignId('page_id')->nullable()->constrained()->cascadeOnDelete();

            $table->string('title')->nullable();

            $table->string('file'); // file path

            $table->enum('type', ['image', 'video', 'audio', 'document', 'link']);

            $table->string('link')->nullable(); // for external links

            $table->string('thumbnail')->nullable();

            $table->integer('size')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
