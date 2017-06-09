<?php
namespace GTAI\Webhook;

interface ActionMapper
{
    public function load(\Closure $closure);    

    public function register($action,  $closure);

    public function getHandler($action);
}
