<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function markNotificationsAsRead(Request $request)
    {
        $notificationIds = collect($request->input('notifications'))->pluck('id')->toArray();
        Notification::whereIn('id', $notificationIds)->update([
            'read_status' => 1,
        ]);
        return response()->json(['message' => 'Notifications read successfully']);
    }
}
