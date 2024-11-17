<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('slug', 128)->unique();
            $table->string('name', 128);
            $table->string('description', 512);
            $table->string('image', 2048)->nullable();
            $table->string('meta_title', 128)->nullable();
            $table->string('meta_description', 376)->nullable();
            $table->string('meta_image', 2048)->nullable();
            $table->timestamps();
        });

        DB::unprepared("ALTER TABLE studios ADD COLUMN searchable tsvector GENERATED ALWAYS AS (to_tsvector('ukrainian', name || ' ' || description)) STORED");
        DB::unprepared('CREATE INDEX studios_searchable_index ON studios USING GIN (searchable)');
    }

    public function down(): void
    {
        DB::unprepared('DROP INDEX IF EXISTS studios_searchable_index');
        Schema::dropIfExists('studios');
    }
};
