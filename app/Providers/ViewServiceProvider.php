<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Vendor;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share vendor data with all views
        View::composer('*', function ($view) {
            // If the vendor is logged in, share their information
            if (session('vendor_id')) {
                $vendor = Vendor::find(session('vendor_id'));
                $view->with('vendor', $vendor);
            }
        });
    }

    public function register()
    {
        //
    }
}
