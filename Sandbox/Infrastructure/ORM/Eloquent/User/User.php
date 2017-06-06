<?php

namespace Sandbox;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use CanResetPassword;

    protected $table = 'users';
    protected $dates = ['deleted_at'];
    protected $fillable = ['email', 'password'];
    protected $hidden = ['password', 'remember_token', 'api_token'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = (Auth::user() ? Auth::user()->id : '1');
            $model->updated_by = (Auth::user() ? Auth::user()->id : '1');
        });

        static::updating(function ($model) {
            $model->updated_by = (Auth::user() ? Auth::user()->id : '1');
        });

        static::deleting(function ($model) {
            $model->deleted_by = (Auth::user() ? Auth::user()->id : '1');
        });

    }
}
