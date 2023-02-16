<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
        $notification =  $user->notifications()->findOrFail($id);
        $notification->markAsRead();
        // $notification->markAsUnread();
        // $notification->delete();

        if (isset($notification->data['url']) && $notification->data['url']) {
            return redirect()->back();
        }
    }
    public function index()
    {
        $user = Auth::user();
        return view('admin.notifications', [
            'notifications' => $user->notifications()->paginate(),

        ]);
    }
}
