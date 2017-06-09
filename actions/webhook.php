<?php

/*
$actionMapper->register('weather',function($request) {
    return ['test'=>$request->action];
});
*/
$actionMapper->register('weather','\\GTAI\\Webhook\\ActionHandlers\\WeatherActionHandler@serve');
