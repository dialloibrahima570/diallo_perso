<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Contact;
use App\Observers\ContactObserver;
use App\Observers\TelechargerCVObserver;
use App\Models\ProjectRequest;
use App\Observers\ProjectRequestObserver;
use App\Models\TelechargerCV;
use App\Models\RequestItem;
use App\Observers\RequestItemObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;



class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Fix MySQL utf8mb4 index length
        Schema::defaultStringLength(191);
        Contact::observe(ContactObserver::class);
       ProjectRequest::observe(ProjectRequestObserver::class);
       TelechargerCV::observe(TelechargerCVObserver::class);





    }
}




