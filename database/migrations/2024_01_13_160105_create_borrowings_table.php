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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('book_id')->nullable(true);
            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->dateTime('borrowing_date')->nullable(false);
            $table->dateTime('due_date')->nullable(false);
            $table->dateTime('delivered_date')->nullable(true);
            $table->boolean('delivered')->nullable(false)->default(false);
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
