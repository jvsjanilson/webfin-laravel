<?php

namespace App\Traits;

use App\Observers\UserObserver;
use App\Scopes\UserScope;

trait UserTrait
{
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);
        static::observe(new UserObserver);
    }
}
