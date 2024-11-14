<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Liamtseva\Cinema\Enums\Gender;
use Liamtseva\Cinema\Enums\Role;

return new class extends Migration
{
    public function up(): void
    {
        $roleValues = implode("','", array_column(Role::cases(), 'value'));
        DB::unprepared("CREATE TYPE role AS ENUM ('$roleValues')");

        $genderValues = implode("','", array_column(Gender::cases(), 'value'));
        DB::unprepared("CREATE TYPE gender AS ENUM ('$genderValues')");

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->ulid('id')->primary();
            $table->renameColumn('name', 'username');
            $table->string('username')->unique()->change();
            //$table->addColumn('raw', 'role', ['raw_type' => 'role'])->default(Role::USER->value);
            $table->typeColumn('role', 'role')->default(Role::USER->value);
            $table->string('avatar', 2048)->nullable();
            $table->string('backdrop', 2048)->nullable();
            //$table->addColumn('raw', 'gender', ['raw_type' => 'gender'])->nullable();
            $table->typeColumn('gender', 'gender')->nullable();
            $table->string('description', 248)->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('allow_adult')->default(false);
            $table->timestamp('last_seen_at')->nullable();
            $table->boolean('is_auto_next')->default(false);
            $table->boolean('is_auto_play')->default(false);
            $table->boolean('is_auto_skip_intro')->default(false);
            $table->boolean('is_private_favorites')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->id();
            $table->renameColumn('username', 'name');

            $table->dropColumn('role');
            $table->dropColumn('avatar');
            $table->dropColumn('backdrop');
            $table->dropColumn('gender');
            $table->dropColumn('description');
            $table->dropColumn('birthday');
            $table->dropColumn('allow_adult');
            $table->dropColumn('last_seen_at');
            $table->dropColumn('is_auto_next');
            $table->dropColumn('is_auto_play');
            $table->dropColumn('is_auto_skip_intro');
            $table->dropColumn('is_private_favorites');
        });

        DB::unprepared('DROP TYPE role');
        DB::unprepared('DROP TYPE gender');
    }
};
