<?php
return [
    'firebase' => [
        'credentials' => [
            'file' => env('FIREBASE_CREDENTIALS', base_path('firebase.json')),
            'discovery_allowed' => true,
        ],
        'database_url' => env('FIREBASE_DATABASE_URL'),
    ],
];
