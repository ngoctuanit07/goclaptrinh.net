<?php
require_once OPS_APPLICATION_PATH . '/services/Optimization/Helper/Abstract/Base.php';

class Ops_Service_Optimization_Helper_HasWords
    extends Ops_Service_Optimization_Helper_Abstract_Base
{
    public function __invoke($text)
    {                 
        return (bool) preg_match('~\w~u', $text);
    }
}