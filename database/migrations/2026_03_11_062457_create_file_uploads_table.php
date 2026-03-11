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
    Schema::create('file_uploads', function (Blueprint $table) {
        $table->id();
        $table->string('filename');
        $table->string('original_filename')->nullable(); // Make it nullable
        $table->string('filepath');
        $table->string('mime_type')->nullable();
        $table->integer('file_size')->nullable();
        $table->string('extension', 10)->nullable();
        $table->foreignId('user_id')->nullable()->constrained();
        $table->text('description')->nullable();
        $table->boolean('is_public')->default(false);
        $table->integer('download_count')->default(0);
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_uploads');
    }
};
