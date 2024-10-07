<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Log;
use App\Services\FirebaseNotificationService;
use App\Models\User;

class NotificationController extends Controller
{
    public function sendNotificationBackup(Request $request)
    {
        // return "base_path('firebase_credentials.json')";
        try {
            $request->validate([
                'title' => 'required|string',
                'body' => 'required|string',
                'token' => 'required|string',
            ]);

            $message = CloudMessage::withTarget('token', $request->token)
                ->withNotification([
                    'title' => $request->title,
                    'body' => $request->body,
                ]);

            $messaging = app('firebase.messaging');  // Changed from 'firebase' to 'firebase.messaging'
            $result = $messaging->send($message);

            Log::info('Notification sent successfully', ['result' => $result]);

            return response()->json(['message' => 'Notification sent successfully', 'result' => $result]);
        } catch (\Exception $e) {
            Log::error('Error sending notification', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while sending the notification',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    protected $firebaseService;

    public function __construct(FirebaseNotificationService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function showForm()
    {
        return view('admin.notification.index');
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_type' => 'required|string',
        ]);
        try {

            $query = User::where('status', '1');

            if($request->user_type == 'user' || $request->user_type == 'vendor'){
                $query->where('user_type', $request->user_type);
            }

            $deviceTokens = $query->pluck('fcm_token')->toArray();

            $result = $this->firebaseService->sendNotification(
                $deviceTokens,
                $request->title,
                $request->body
            );

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Notifications sent', 'result' => $result]);
            }

            return redirect()->back()->with('success', 'Notifications sent successfully');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Failed to send notifications: ' . $e->getMessage())->withInput();
        }
    }
}
