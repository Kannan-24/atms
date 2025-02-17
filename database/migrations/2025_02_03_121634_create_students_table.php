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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('roll_number', 50)->unique();
            $table->string('class', 50);
            $table->string('section', 10);
            $table->date('dob');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->text('address');
            $table->foreignId('parent_id')->constrained('parents')->onDelete('cascade');
            $table->string('email', 100)->unique();
            $table->string('phone', 15);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
