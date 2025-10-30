<?php
return [
    'credentials' => [
        'file' => storage_path('app/firebase/unit-1c26a-firebase-adminsdk-fbsvc-3a8433df29.json'),
    ],
    'database' => [
        'url' => env('FIREBASE_DATABASE_URL', 'https://unit-1c26a.firebaseio.com'),
    ],
];
