<?php

namespace Sandbox;

class Widget extends BaseModel {

    protected $table = 'widgets';

    /**
     *
     * Eloquent relations are refined below
     *
     */

    public function lots()
    {
        return $this->belongsTo('Sandbox\User');
    }
}