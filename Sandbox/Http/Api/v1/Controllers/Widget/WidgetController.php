<?php

namespace Sandbox\Http\Api\v1\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Sandbox\Events\Widget\WidgetWasAdded;
use Sandbox\Events\Widget\WidgetWasDeleted;
use Sandbox\Events\Widget\WidgetWasEdited;
use Sandbox\Http\Controllers\Controller;
use Sandbox\Jobs\Widget\AddWidget;
use Sandbox\Jobs\Widget\DeleteWidget;
use Sandbox\Jobs\Widget\EditWidget;
use Sandbox\Repositories\Widget\WidgetRepository;
use Sandbox\Widget;


class WidgetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(WidgetRepository $widget)
    {
        $this->middleware('auth');
        $this->widget       =   $widget;
    }

    /**
     * Get all widgets.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $widgets = $this->widget->getAllByWeight();

        return compact('widgets');
    }

    /**
     * Add a new widget.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $widget =   $this->dispatchFrom(AddWidget::class, $request);
        Event::fire(new WidgetWasAdded($widget->id, $request->all()));

        return compact('widget');
    }

    public function edit(Request $request)
    {
        $widget =   $this->dispatchFrom(EditWidget::class, $request);
        event(new WidgetWasEdited($widget->id, $request));

        return compact('widget');
    }

    public function delete(Request $request)
    {
        $widget = $this->dispatchFrom(DeleteWidget::class, $request);
        event(new WidgetWasDeleted($widget->id, $request));

        return compact('widget');
    }


}