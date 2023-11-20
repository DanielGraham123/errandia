<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\Http\Resources\NotificationResource;
use App\Models\User;

class NotificationController extends Controller
{
    public function index() {
        $notifications = DatabaseNotification::where('notifiable_type', User::class)
            ->where('notifiable_id', auth('api')->user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(50);

        return response()->json(['data' => [
            'notifications' => NotificationResource::collection($notifications)
        ]]);
    }

    public function unreadCount() {
        return response()->json(['data' => [
            'success' => 200,
            'unread' => auth('api')->user()->unreadNotifications->count()
        ]]);
    }

    public function markAllRead() {
        auth('api')->user()->unreadNotifications->markAsRead();
        return response()->json([]);
    }
}
