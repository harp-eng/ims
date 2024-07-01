<?php

namespace Modules\RawMaterialPurchase\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        /**
         * Backend
         */
        'Modules\RawMaterialPurchase\Events\Backend\NewCreated' => [
            'Modules\RawMaterialPurchase\Listeners\Backend\NewCreated\UpdateAllOnNewCreated',
        ],
        
        /**
         * Frontend
         */
    ];
}
