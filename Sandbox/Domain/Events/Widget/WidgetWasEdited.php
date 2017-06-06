<?php namespace Sandbox\Events\Widget;

use Sandbox\Events\Event;
use Illuminate\Queue\SerializesModels;

class WidgetWasEdited extends Event {

    use SerializesModels;

    public $widgetId;
    public $request;

    public function __construct($widgetId, $request)
    {
        $this->widgetId = $widgetId;
        $this->request = $request;
    }

}