<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class UserObserver
{
    public function creating(Model $model)
    {

        if (auth()->check())
            $model->setAttribute('user_id', auth()->user()->id);
    }

}
