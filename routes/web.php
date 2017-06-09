<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->post('/webhook',function(Request $request) {
    $requestRaw = $request->getContent();
    $request = json_decode($requestRaw);
    if(json_last_error()) {
        return ['data'=>['error_msg'=>'Request JSON String '.json_last_error_msg(),'request'=>$requestRaw]];
    }
    $webhookController = new \App\Http\Controllers\WebhookController();
    return $webhookController->serve($request);
});
