<?php

namespace Sandbox\Http\Api\v1\Controllers;

use Illuminate\Http\Request;
use Sandbox\Http\Controllers\Controller;
use Sandbox\Notifications\SampleNotification;


class WidgetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all widgets.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Limit the number of returned notifications, or return all
        $query = $user->unreadNotifications();
        $limit = (int) $request->input('limit', 0);
        if ($limit) {
            $query = $query->limit($limit);
        }
        $query->latest();

        $notifications = $query->get()->each(function ($n) {
            $n->created = $n->created_at->toIso8601String();
        });

        $total = $user->unreadNotifications->count();

        return compact('notifications', 'total');
    }

    /**
     * Create a new widget.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $widget = $this->dispatchFrom(AddWidget::class, $request);
        Event::fire(new WidgetWasAdded($widget->id, $request->all()));

        return compact($widget);
    }

    /**
     * Mark user's notification as read.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()
            ->unreadNotifications()
            ->where('id', $id)
            ->first();

        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }

        $notification->markAsRead();

        return response()->json('Notification #' . $id .  ' dismissed successfully.', 200);
    }

    /**
     * Mark all user's notifications as read.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function markAllRead(Request $request)
    {
        $notifications = $request->user()->unreadNotifications();

        $count = $notifications->count();

        $notifications->get()->each(function ($notification)
        {
            $notification->markAsRead();
        });

        return response()->json($count . ' notifications dismissed successfully.', 200);
    }


}