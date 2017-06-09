<?php
namespace GTAI\Webhook\ActionHandlers;

class WeatherActionHandler
{
    public function serve($request)
    {
        $yql_query = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='".$request->result->parameters->address->city.($request->result->parameters->address->city==='Singapore'?',SG':'')."') and u='c'";
        $yql_url = "https://query.yahooapis.com/v1/public/yql?q=" . urlencode($yql_query) . "&format=json";
       
        $response = file_get_contents($yql_url); //TODO change to use guzzle to get data

        $responseObject = json_decode($response);
        $channel = $responseObject->query->results->channel;
        $item = $channel->item;
        $location = $channel->location;
        $units = $channel->units;
        $condition = $item->condition;
        $speech = "Today in {$location->city}:  {$condition->text}".
             ", the temperature is {$condition->temp} {$units->temperature}";
        return [
        "speech"=> $speech,
        "displayText"=> $speech,
        "source"=> "apiai-weather-webhook-sample"
        ];
    }
}
