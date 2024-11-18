<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('selections', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('name', 128);
            $table->text('description')->nullable();
            $table->string('meta_title', 128)->nullable();
            $table->string('meta_description', 376)->nullable();
            $table->string('meta_image', 2048)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('selections');
    }
};
