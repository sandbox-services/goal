<?php

namespace Sandbox\Jobs\Widget;


use Sandbox\Jobs\Job;
use Sandbox\Repositories\Widget\WidgetRepository;

class EditWidget extends Job
{
    function __construct($id, $content = null, $weight = null)
    {
        $this->id           =   $id;
        $this->content      =   $content;
        $this->weight       =   $weight;
    }

    public function handle(WidgetRepository $repository)
    {
        $widget = $repository->edit($this);

        return $widget;
    }
}