<?php
namespace GTAI\Webhook;

interface ActionMapper
{
    public function load(\Closure $closure);    

    public function register(String $action,  $closure);

    public function getHandler(String $action);
}
