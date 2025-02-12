<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'host' => env('SPLYNXAPI_HOST_URL', 'https://'),
    'key' => env('SPLYNXAPI_KEY', ''),
    'secret' => env('SPLYNXAPI_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    // 'character_limit' => env('EASYPAY_CHARACTER_LIMIT', '6'),
    // '' => env('EASYPAY_TOTAL_CHARACTER_LENGTH', '12'),
 ];
