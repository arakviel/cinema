<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('movie_person', function (Blueprint $table) {
            $table->foreignUlid('movie_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('person_id')->constrained()->cascadeOnDelete();
            $table->string('character_name', 128);

            $table->primary(['movie_id', 'person_id']); // Первинний ключ на обидва поля
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_person');
    }
};
