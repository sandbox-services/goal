<?php

namespace Sandbox;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class BaseModel extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = ['id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'];

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
