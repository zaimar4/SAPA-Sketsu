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
      Schema::create('complaints', function (Blueprint $table) {
    $table->id();
    
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
    $table->string('title');
    $table->string('ticket_number')->unique();
    $table->string('slug')->unique(); 
    $table->text('description');

    $table->enum('category', ['bullying', 'facilities', 'suggestion']);
    $table->enum('status', ['pending', 'process', 'resolved', 'rejected'])->default('pending');
    $table->boolean('is_anonymous')->default(false);
    $table->string('evidence_photo')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
