<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Liamtseva\Cinema\Enums\CommentReportType;

return new class extends Migration
{
    public function up(): void
    {
        $reportValues = implode("','", array_column(CommentReportType::cases(), 'value'));
        DB::unprepared("CREATE TYPE comment_report_type AS ENUM ('$reportValues')");

        Schema::create('comment_reports', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('comment_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('user_id')->constrained()->cascadeOnDelete();
            $table->typeColumn('comment_report_type', 'type');
            $table->boolean('is_viewed')->default(false);
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_reports');
        DB::unprepared('DROP TYPE comment_report_type');
    }
};
