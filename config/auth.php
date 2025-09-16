<?php
return [
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    // 👇 guard for passengers
    'passenger' => [
        'driver' => 'session',
        'provider' => 'passengers',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => env('AUTH_MODEL', App\Models\User::class),
    ],

    // 👇 provider for passengers
    'passengers' => [
        'driver' => 'eloquent',
        'model' => App\Models\Passenger::class,
    ],
],

'passwords' => [
    'users' => [
        'provider' => 'users',
        'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
        'expire' => 60,
        'throttle' => 60,
    ],

    // 👇 password broker for passengers
    'passengers' => [
        'provider' => 'passengers',
        'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
        'expire' => 60,
        'throttle' => 60,
    ],
],
'password_timeout' => 10800,
];