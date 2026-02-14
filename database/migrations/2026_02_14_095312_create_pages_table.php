<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pages', function (Blueprint $table) {

        $table->id();

        $table->string('title');

        $table->text('description')->nullable();

        $table->string('image')->nullable();

        // SEO Fields

        $table->string('seo_title')->nullable();

        $table->text('seo_description')->nullable();

        $table->string('seo_keywords')->nullable();

        $table->string('seo_image')->nullable();

        // status

        $table->boolean('status')->default(1);

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
