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
        Schema::create('sub_event_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_event_id')->constrained()->onDelete('cascade');
            $table->string('label');
            $table->string('file_path');          // file path in local storage
            $table->string('file_type', 10);      // "pdf" | "docx"
            $table->unsignedInteger('file_size_bytes');
            $table->unsignedInteger('order')->default(0);
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamp('uploaded_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_event_documents');
    }
};
