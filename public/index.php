<?php

/*
|--------------------------------------------------------------------------
| Define The Application's Base Path
|--------------------------------------------------------------------------
|
| This is the absolute path to your main Laravel application folder,
| which lives one level above the public_html directory.
|
*/
$app_path = '/home/pl3hb1hv1mjf/website-laravel';


/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/
require $app_path . '/vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/
$app = require_once $app_path . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
