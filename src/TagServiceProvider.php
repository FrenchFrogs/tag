<?php namespace FrenchFrogs\Tag;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/create_tag_table.php' => database_path('migrations/' . Carbon::now()->format('Y_m_d_His') . '_create_tag_table.php'),
        ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
