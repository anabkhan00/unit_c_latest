<?php
return [
    'credentials' => [
        'file' => storage_path('app/firebase/unit-1c26a-firebase-adminsdk-fbsvc-94a018a973.json'),
    ],
    'database' => [
        'url' => env('FIREBASE_DATABASE_URL', 'https://unit-1c26a-default-rtdb.firebaseio.com'),
    ],
];
