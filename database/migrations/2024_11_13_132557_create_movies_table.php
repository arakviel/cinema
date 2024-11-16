<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Liamtseva\Cinema\Enums\Kind;
use Liamtseva\Cinema\Enums\Period;
use Liamtseva\Cinema\Enums\RestrictedRating;
use Liamtseva\Cinema\Enums\Source;
use Liamtseva\Cinema\Enums\Status;
use Liamtseva\Cinema\Enums\VideoQuality;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $kindValues = implode("','", array_column(Kind::cases(), 'value'));
            DB::unprepared("CREATE TYPE kind AS ENUM ('$kindValues')");
            $statusValues = implode("','", array_column(Status::cases(), 'value'));
            DB::unprepared("CREATE TYPE status AS ENUM ('$statusValues')");
            $periodValues = implode("','", array_column(Period::cases(), 'value'));
            DB::unprepared("CREATE TYPE period AS ENUM ('$periodValues')");
            $restrictedRatingValues = implode("','", array_column(RestrictedRating::cases(), 'value'));
            DB::unprepared("CREATE TYPE restricted_rating AS ENUM ('$restrictedRatingValues')");
            $sourceValues = implode("','", array_column(Source::cases(), 'value'));
            DB::unprepared("CREATE TYPE source AS ENUM ('$sourceValues')");
            $videoQualityValues = implode("','", array_column(VideoQuality::cases(), 'value'));
            DB::unprepared("CREATE TYPE video_quality AS ENUM ('$videoQualityValues')");

            $table->ulid('id')->primary(); // Унікальний ідентифікатор
            $table->json('api_sources')->default(DB::raw("'[]'::json")); // JSON для API ідентифікаторів (source, id)
            $table->string('slug', 128)->unique(); // Унікальний slug
            $table->string('name', 248); // Назва фільму
            $table->string('image_name', 2048); // Шлях до зображення
            $table->json('aliases')->default(DB::raw("'[]'::json")); // JSON для масиву аліасів
            $table->typeColumn('kind', 'kind');
            $table->typeColumn('status', 'status');
            $table->typeColumn('period', 'period');
            $table->typeColumn('restricted_rating', 'restricted_rating');
            $table->typeColumn('source', 'source');
            $table->typeColumn('video_quality', 'quality');
            $table->json('countries')->default(DB::raw("'[]'::json")); // JSON країн розробників enum Country
            $table->string('poster', 2048)->nullable(); // Шлях до постера
            $table->integer('duration')->nullable(); // Тривалість у хвилинах
            $table->integer('episodes_count')->nullable(); // Кількість епізодів
            $table->date('first_air_date')->nullable(); // Дата початку ефіру
            $table->date('last_air_date')->nullable(); // Дата завершення ефіру
            $table->decimal('imdb_score', 2, 1)->nullable(); // Оцінка на IMDB
            $table->json('attachments')->nullable()->default(DB::raw("'[]'::json")); // JSON для масиву прикріплених елементів
            $table->json('related')->nullable()->default(DB::raw("'[]'::json")); // JSON для пов'язаних елементів
            $table->json('similars')->nullable()->default(DB::raw("'[]'::json")); // JSON для схожих фільмів
            $table->boolean('is_published')->default(false); // Статус публікації
            $table->string('meta_title', 128)->nullable();
            $table->string('meta_description', 376)->nullable();
            $table->string('meta_image', 2048)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');

        DB::unprepared('DROP TYPE video_quality');
        DB::unprepared('DROP TYPE source');
        DB::unprepared('DROP TYPE restricted_rating');
        DB::unprepared('DROP TYPE period');
        DB::unprepared('DROP TYPE status');
        DB::unprepared('DROP TYPE kind');
    }
};
