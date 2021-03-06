<?php

namespace Sandbox\Repositories\Widget;

use Sandbox\Repositories\EloquentRepository;
use Sandbox\Widget;

class EloquentWidgetRepository extends EloquentRepository implements WidgetRepository {

    function __construct(Widget $model)
    {
        $this->model = $model;
    }


    public function getAllByWeight()
    {
        $widgets    =   Widget::orderBy('weight', 'asc');

        return $widgets->get();
    }

    function add($job)
    {
        $widget             =   new Widget;
        $widget->content    =   $job->content;
        $widget->weight     =   $job->weight;

        if($widget->save())
            return $widget;
    }

    function edit($job)
    {
        $widget     =   Widget::findOrFail($job->id);

        if( isset($job->content) )
            $widget->content            =   $job->content;

        if( isset($job->weight) )
            $widget->weight             =   $job->weight;

        if($widget->save())
            return $widget;
    }

    function delete($job)
    {
        $widget  =   Widget::findOrFail($job->id);
        $widget->delete();

        return $widget;
    }
}