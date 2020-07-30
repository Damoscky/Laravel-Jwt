<?php


namespace Damoscky\Contact;

use Illuminate\Support\ServiceProvider;


class ContactServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__. '/views', 'contact');
    }

    public function register()
    {
        # code...
    }

}
