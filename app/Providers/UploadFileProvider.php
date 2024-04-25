<?php

namespace App\Providers;

use App\Http\Controllers\CollapsibleController;
use App\Services\UploadFileService;
use Illuminate\Support\ServiceProvider;

class UploadFileProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
