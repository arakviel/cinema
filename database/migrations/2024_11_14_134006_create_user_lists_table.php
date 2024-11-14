<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Liamtseva\Cinema\Enums\UserListType;

return new class extends Migration
{
    public function up(): void
    {
        $kindValues = implode("','", array_column(UserListType::cases(), 'value'));
        DB::unprepared("CREATE TYPE user_list_type AS ENUM ('$kindValues')");

        Schema::create('user_lists', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->constrained()->cascadeOnDelete();
            $table->ulidMorphs('listable');
            $table->typeColumn('user_list_type', 'type');
            $table->timestamps();

            $table->unique(['user_id', 'listable_id', 'listable_type']); // Запобігає дублюванню у списку одного користувача
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_lists');

        DB::unprepared('DROP TYPE user_list_type');
    }
};
