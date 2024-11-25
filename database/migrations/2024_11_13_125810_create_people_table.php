<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Liamtseva\Cinema\Enums\PersonType;

return new class extends Migration
{
    public function up(): void
    {
        $personTypeValues = implode("','", array_column(PersonType::cases(), 'value'));
        DB::unprepared("CREATE TYPE person_type AS ENUM ('$personTypeValues')");

        Schema::create('people', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->typeColumn('person_type', 'type');
            $table->string('slug', 128)->unique();
            $table->string('name', 128);
            $table->string('original_name', 128)->nullable();
            $table->typeColumn('gender', 'gender')->nullable();
            $table->string('image', 2048)->nullable();
            $table->string('description', 512)->nullable();
            $table->date('birthday')->nullable();
            $table->string('birthplace', 248)->nullable();
            $table->string('meta_title', 128)->nullable();
            $table->string('meta_description', 376)->nullable();
            $table->string('meta_image', 2048)->nullable();
            $table->timestamps();
        });

        DB::unprepared("
            ALTER TABLE people
            ADD COLUMN searchable tsvector GENERATED ALWAYS AS (
                setweight(to_tsvector('ukrainian', name), 'A') ||
                setweight(to_tsvector('english', coalesce(original_name, '')), 'A') ||
                setweight(to_tsvector('ukrainian', coalesce(description, '')), 'B')
            ) STORED
        ");

        DB::unprepared('CREATE INDEX people_searchable_index ON people USING GIN (searchable)');
        DB::unprepared('CREATE INDEX people_trgm_name_idx ON people USING GIN (name gin_trgm_ops)');
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
        DB::unprepared('DROP TYPE person_type');

        DB::unprepared('DROP INDEX IF EXISTS people_searchable_index');
        DB::unprepared('DROP INDEX IF EXISTS people_trgm_name_idx');
    }
};
