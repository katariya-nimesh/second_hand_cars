<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;


class NotificationsController extends Controller
{
    // Get all notifications for the authenticated user
    public function index()
    {
        try{
            $user = Auth::user();
            $notifications = Notifications::where('user_id', $user->id)->get();
            return ResponseHelper::success($notifications, 'Notifications data retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    // Add a new notification
    public function store(Request $request)
    {
        try{

            $request->validate([
                'title' => 'required|string|max:255',
                'datetime' => 'required|date',
            ]);

            $user = Auth::user();
            $notification = Notifications::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'datetime' => $request->datetime,
            ]);
            return ResponseHelper::success($notification, 'Notification created successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    // Delete a notification
    public function destroy($id)
    {
        try{

            $user = Auth::user();
            $notification = Notifications::where('user_id', $user->id)->where('id', $id)->first();

            if ($notification) {
                $notification->delete();
                return ResponseHelper::success(null, 'Notification deleted successfully');
            }

            return ResponseHelper::error('Notification not found', 404);
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
