<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Log;
use App\Services\FirebaseNotificationService;

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

    public function sendNotification(Request $request)
    {
        try {
            $result = $this->firebaseService->sendNotification(
                $request->device_token,
                $request->title,
                $request->body
            );
            return response()->json(['message' => 'Notification sent successfully', 'result' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
