<?php
namespace Sandbox\Jobs\Widget;

use Sandbox\Repositories\Widget\WidgetRepository;
use Sandbox\Jobs\Job;



class DeleteWidget extends Job
{
    function __construct($id)
    {
        $this->id   =   $id;
    }

    public function handle(WidgetRepository $repository)
    {
        $widget = $repository->delete($this);

        return $widget;
    }
}