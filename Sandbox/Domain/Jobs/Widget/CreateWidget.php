<?php

namespace Sandbox\Jobs\Widget;

use Sandbox\Repositories\Widget\WidgetRepository;
use Sandbox\Jobs\Job;

class CreateWidget extends Job
{
    public $content;
    public $weight;

    function __construct($content, $weight = null)
    {
        $this->content = $content;
        $this->weight = $weight;
    }

    public function handle(WidgetRepository $repository)
    {
        $widget = $repository->add($this);

        return $widget;
    }
}