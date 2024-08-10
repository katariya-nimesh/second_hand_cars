<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

class PushNotificationsController extends Controller
{
    public function showForm()
    {
        return view('admin.send_notification');
    }

    public function sendTopicNotification(Request $request)
    {
        $messaging = app(Messaging::class);

        $message = CloudMessage::new()
            ->withNotification([
                'title' => 'New Notification',
                'body' => 'This is a test notification.',
            ])
            ->withTopic('user');

        try {
            $messaging->send($message);
            return redirect()->back()->with('success', 'Notification sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send notification: ' . $e->getMessage());
        }
    }
}

