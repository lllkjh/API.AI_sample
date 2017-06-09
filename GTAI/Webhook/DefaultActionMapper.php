<?php
namespace GTAI\Webhook;

class DefaultActionMapper implements ActionMapper
{
    private $_mapper = [];

    public function load(\Closure $closure)
    {
        $closure($this);
    }

    public function register(String $action, $closure)
    {
        $this->_mapper[$action] = $closure;
    }

    public function getHandler(String $action) 
    {
        $handler = $this->_mapper[$action];
        if(is_object($handler) && ($handler instanceof Closure)) 
            return $handler;
        if(is_string($handler)) {
            if (strpos($handler, '@') !== false) {
                list($className,$functionName) = explode('@',$handler);
                $instance = new $className();
                return function($request) use($instance,$functionName){
                        return $instance->$functionName($request);
                };
            } else {
                $instance = new $handler();
                return function($request) use($instance){
                        return $instance->serve($request);
                };
            }
        }
        return false;
    }
}
