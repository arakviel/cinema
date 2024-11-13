<?php

namespace Liamtseva\Cinema\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\Fluent;
use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Grammar::macro('typeRaw', function (Fluent $column) {
            return $column->get('raw_type');
        });

        Blueprint::macro('typeColumn', function (string $type, string $columnName) {
            return $this->addColumn('raw', $columnName, ['raw_type' => $type]);
        });
    }
}
