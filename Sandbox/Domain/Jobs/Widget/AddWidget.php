<?php

namespace Sandbox\Jobs\Widget;

use Sandbox\Repositories\Widget\WidgetRepository;
use Sandbox\Jobs\Job;

class AddWidget extends Job
{
    public $content;
    public $weight;

    function __construct($content = null, $weight = 100)
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