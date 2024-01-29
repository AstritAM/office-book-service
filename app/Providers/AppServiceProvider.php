<?php

namespace App\Providers;

use App\Http\Resources\OfficeCollection;
use App\Http\Resources\OfficeResource;
use App\Http\Resources\PlaceCollection;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\RoomResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        OfficeResource::withoutWrapping();
        PlaceResource::withoutWrapping();
        RoomResource::withoutWrapping();
        OfficeCollection::withoutWrapping();
        PlaceCollection::withoutWrapping();
        RoomCollection::withoutWrapping();
    }
}
