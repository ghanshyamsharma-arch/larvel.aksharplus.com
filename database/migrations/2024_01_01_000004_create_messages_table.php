<?php
// FILE: database/migrations/2024_01_01_000004_create_messages_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('users');
            $table->text('body')->nullable();
            $table->enum('type', ['text','image','file','audio','video','link','system'])->default('text');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('is_edited')->default(false);
            $table->timestamp('edited_at')->nullable();
            $table->json('metadata')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('messages')->nullOnDelete();
        });

        Schema::create('message_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('emoji', 10);
            $table->timestamps();
            $table->unique(['message_id', 'user_id', 'emoji']);
        });

        Schema::create('pinned_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('message_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pinned_by')->constrained('users');
            $table->timestamps();
            $table->unique(['channel_id', 'message_id']);
        });

        Schema::create('scheduled_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('users');
            $table->text('body');
            $table->timestamp('scheduled_at');
            $table->timestamp('sent_at')->nullable();
            $table->enum('status', ['pending','sent','cancelled'])->default('pending');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('shared_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('channel_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('message_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('uploaded_by')->constrained('users');
            $table->string('original_name');
            $table->string('file_path');
            $table->enum('file_type', ['image','video','audio','document','link']);
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('thumbnail_path')->nullable();
            $table->json('metadata')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shared_files');
        Schema::dropIfExists('scheduled_messages');
        Schema::dropIfExists('pinned_messages');
        Schema::dropIfExists('message_reactions');
        Schema::dropIfExists('messages');
    }
};
