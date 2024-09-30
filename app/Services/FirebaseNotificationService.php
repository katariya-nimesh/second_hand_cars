<?php

namespace App\Services;

use Google\Client;
use Google\Service\FirebaseCloudMessaging\SendMessageRequest;
use Google\Service\FirebaseCloudMessaging\Message;
use Google\Service\FirebaseCloudMessaging\Notification;
use Illuminate\Support\Facades\Http;

class FirebaseNotificationService
{
    protected $client;
    protected $projectId;

    public function __construct()
    {
        $this->projectId = config('services.firebase.project_id');
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/firebase/service-account.json'));
        $this->client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    }

    public function sendNotification($deviceToken, $title, $body)
    {
        $accessToken = $this->client->fetchAccessTokenWithAssertion()['access_token'];

        $response = Http::withToken($accessToken)
            ->post("https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send", [
                'message' => [
                    'token' => $deviceToken,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                ],
            ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception('Failed to send notification: ' . $response->body());
        }
    }
}
