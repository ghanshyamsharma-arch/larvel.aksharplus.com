<?php
// FILE: database/migrations/2024_01_01_000003_create_channels_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->enum('type', ['general', 'private', 'direct'])->default('general');
            $table->boolean('is_private')->default(false);
            $table->foreignId('created_by')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['company_id', 'slug']);
        });

        Schema::create('channel_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['channel_id', 'user_id']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('channel_members');
        Schema::dropIfExists('channels');
    }
};
